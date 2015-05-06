<form action="/users/register" method="post">
    <div class="input-group">
        <label for="username">Username</label>
        <input id="username" class="form-control" type="text" name="username" required="true"/>
    </div>
    <div class="input-group">
        <label for="password">Password</label>
        <input id="password" class="form-control" type="password" name="password" required="true"/>
    </div>
    <div class="input-group">
        <label for="confirm-password">Confirm password</label>
        <input id="confirm-password" class="form-control" type="password" name="confirm-password" required="true"/>
    </div>
    <div class="input-group">
        <label for="email">Email</label>
        <input id="email" class="form-control" type="email" name="email" required="true"/>
    </div>
    <div class="input-group">
        <label for="first-name">First name</label>
        <input id="first-name" class="form-control" type="text" name="first-name" required="true"/>
    </div>
    <div class="input-group">
        <label for="last-name">Last name</label>
        <input id="last-name" class="form-control" type="text" name="last-name" required="true"/>
    </div>
    <input type="submit"/>
</form>
