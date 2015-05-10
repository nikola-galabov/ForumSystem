<div class="col-md-9">
    <h4>Please fill the form below to login in the system.</h4>
    <form action="/users/login" method="post">
        <div class="form-group">
            <label for="username">Username</label>
            <input id="username" name="username" class="form-control" type="text" required="true"/>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input id="password" class="form-control" type="password" name="password" required="true"/>
        </div>
        <input class="btn btn btn-default" type="submit"/>
    </form>
</div>