<div class="col-md-9">
    <form action="/users/register" method="post">
        <div class="form-group">
            <label for="username">Username</label>
            <input id="username" class="form-control" type="text" name="username" required="true"/>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input id="password" class="form-control" type="password" name="password" required="true"/>
        </div>
        <div class="form-group">
            <label for="confirm-password">Confirm password</label>
            <input id="confirm-password" class="form-control" type="password" name="confirm-password" required="true"/>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input id="email" class="form-control" type="email" name="email" required="true"/>
        </div>
        <div class="form-group">
            <label for="first-name">First name</label>
            <input id="first-name" class="form-control" type="text" name="first-name" required="true"/>
        </div>
        <div class="form-group">
            <label for="last-name">Last name</label>
            <input id="last-name" class="form-control" type="text" name="last-name" required="true"/>
        </div>
        <input class="btn btn-default" type="submit"/>
    </form>
</div>