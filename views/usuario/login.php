<?php require_once 'views/layout/header.php'; ?>
<div class="container">
    <div class="m-0 row justify-content-center text-center">
        <form class="form-signin" method="POST" action="<?=base_url?>usuario/login">
                <h1 class="h3 mb-3 font-weight-normal">Inicie sesión</h1>
                <label for="inputEmail" class="sr-only">Usuario</label>
                <input
                    type="text"
                    id="inputEmail"
                    class="form-control"
                    placeholder="Usuario"
                    required
                    name="username"
                    autofocus="">
                    <label for="inputPassword" class="sr-only">Contraseña</label>
                    <input
                        type="password"
                        id="inputPassword"
                        class="form-control"
                        placeholder="Contraseña"
                        required
                        name="password">
                        <div class="checkbox mb-3">
                            <label>
                                <input type="checkbox" value="remember-me">
                                    Recuerdame
                                </label>
                            </div>
                            <button class="btn btn-lg btn-primary btn-block" type="submit">Iniciar sesión</button>
                        </form>
                    </div>
                </div>
<?php require_once 'views/layout/footer.php'; ?>               