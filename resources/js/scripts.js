const apiUrl = window.location.href + '/api/v1/'
const getCookieValue = () => (
    document.cookie.match('(^|;)\\s*' + 'token' + '\\s*=\\s*([^;]+)')?.pop() || ''
)
let loadMore = $('#loadMore')

usersIndex()
$.ajax({
    url: apiUrl + 'positions',
    method: 'GET',
    success: function (positions) {
        let positionSelect = $('#positionC')
        for (let i in positions.positions) {
            positionSelect.append('<option value="' + positions.positions[i].id + '">' + positions.positions[i].name + '</option>')
        }
    }
})

function usersIndex(url = false) {
    $.ajax({
        url: url ? url : apiUrl + 'users',
        method: 'GET',
        headers: {
            Accept: 'application/json'
        },
        success: function (users) {
            loadMore.off()
            let usersList = $('#usersList')
            for (let i in users.users) {
                usersList.append('<div class="bg-light rounded p-2 d-flex justify-content-between align-items-center">\n' +
                    '                    <img src="' + users.users[i].photo + '" alt="photo">\n' +
                    '                    <div>' + users.users[i].name + '</div>\n' +
                    '                    <div>' + users.users[i].position + '</div>\n' +
                    '                    <button class="btn-success btn" data-bs-toggle="modal" data-bs-target="#userShow" id="user-' + users.users[i].id + '">More details\n' +
                    '                    </button>\n' +
                    '                </div>')
                $('#user-' + users.users[i].id).click(function () {
                    $.ajax({
                        url: apiUrl + 'users/' + users.users[i].id,
                        method: 'GET',
                        headers: {
                            Accept: 'application/json'
                        },
                        success: function (user) {
                            $('#user-photo').attr('src', users.users[i].photo)
                            $('#user-name').text(user.user.name)
                            $('#user-id').text(user.user.id)
                            $('#user-email').text(user.user.email)
                            $('#user-phone').text(user.user.phone)
                            $('#user-position-id').text(user.user.position_id)
                            $('#user-position').text(user.user.position)
                            $('#user-timestamp').text(user.user.registration_timestamp)
                        }
                    })
                })
            }
            loadMore.click(function () {
                users.links.next_url !== null ? usersIndex(users.links.next_url) : alertMessage('No more users')
            })
        }
    })
}

function alertMessage(message) {
    function alertDisplay() {
        $('#alert').toggleClass('d-none', 'd-block')
    }

    $('#alertMessage').text(message)
    alertDisplay()
    setTimeout(function () {
        alertDisplay()
    }, 2500)
}

$('#getToken').click(function () {
    $.ajax({
        url: apiUrl + 'token',
        method: 'GET',
        success: function (token) {
            document.cookie = 'token=' + token.token
            alertMessage('Token received')
        }
    })
})

$('#createUserSubmit').click(function () {
    // let form = document.getElementById('form')
    let formData = new FormData(document.getElementById('form'));
    $.ajax({
        url: apiUrl + 'users',
        method: 'POST',
        processData: false,
        contentType: false,
        headers: {
            Accept: 'application/json',
            'Authorization': 'Bearer ' + getCookieValue()
        },
        data: formData,
        error: function (error) {
            let form = $('form')
            alertMessage(error.responseJSON.message)
            $('.fail').remove()
            for (let i in error.responseJSON.fails) {
                error.responseJSON.fails[i].forEach(fail => form.after('<div class="text-danger fail">' + fail + '</div>'))
            }
        }
    }).done(function (response) {
        alertMessage(response.message)
    })
})
