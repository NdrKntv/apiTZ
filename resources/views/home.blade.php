<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <title>home</title>
</head>
<body>
<div class="container">
    <div class="row justify-content-around">
        <div class="col-2">
            <button class="btn btn-primary mt-3" id="getToken">Get token</button>
        </div>
        <div class="col-6">
            <div class="d-flex flex-wrap flex-column gap-1" id="usersList">
            </div>
            <button class="btn btn-primary mt-3" id="loadMore">Load more</button>
        </div>
        <div class="col-4">
            <h5>Create new user</h5>
            <form id="form">
                <div class="mb-3">
                    <label for="nameC" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" id="nameC">
                </div>
                <div class="mb-3">
                    <label for="emailC" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="emailC">
                </div>
                <div class="mb-3">
                    <label for="phoneC" class="form-label">Phone</label>
                    <input type="text" class="form-control" name="phone" id="phoneC">
                </div>
                <div class="mb-3">
                    <select class="form-select" name="position_id" id="positionC">
                        <option selected value="">Position</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="photoC" class="form-label">Photo</label>
                    <input type="file" class="form-control" name="photo" id="photoC">
                </div>
            </form>
            <button type="button" class="btn btn-primary" id="createUserSubmit">Submit</button>
        </div>
    </div>
</div>
<div class="modal fade" id="userShow" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <img src="" id="user-photo" alt="photo">
                <h5 class="modal-title mx-3" id="user-name"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div>id: <span id="user-id"></span></div>
                <div>email: <span id="user-email"></span></div>
                <div>phone: <span id="user-phone"></span></div>
                <div>position id: <span id="user-position-id"></span></div>
                <div>position: <span id="user-position"></span></div>
                <div>timestamp: <span id="user-timestamp"></span></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="d-none" id="alert">
    <div class="alert alert-primary d-flex align-items-center fixed-bottom w-25 mx-3">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
             class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img"
             aria-label="Warning:">
            <path
                d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
        </svg>
        <div id="alertMessage">
        </div>
    </div>
</div>
</body>
<script src="{{asset('js/app.js')}}"></script>
</html>
