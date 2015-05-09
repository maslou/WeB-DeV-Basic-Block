<div id="login" class="container well">
    <form class="form-horizontal col-lg-9" method="post" action="/account/logIn">
        <fieldset>
            <div class="form-group col-sm-3">
                <label for="title" class="control-label">UserName:*</label>
                <input type="text" name="UserName" class="form-control" required="">
             </div>
            <div class="form-group col-sm-3">
                <label for="title" class="control-label">Password:*</label>
                <input type="password" name="pass" class="form-control" required="">
            </div>
            <div class="form-group col-sm-3">
                <button class="btn" type="submit">Login</button>
            </div>
        </fieldset>
    </form>
</div>