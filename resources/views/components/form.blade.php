@php

  $rutaSubmit = "";
  $titulo = "";
  
  if($tipo=='registro'){
    $titulo = 'Registrarse';
    $rutaSubmit = route('do-register');
  }else{
    $titulo = 'Iniciar sesión';
    $rutaSubmit = route('do-login');
  }

@endphp
<form method="POST" action="{{$rutaSubmit}}">
  @csrf
  <h1>{{$titulo}}</h1>
  @if($tipo=='registro')
    <div class="mb-3">
      <label for="inputEmail" class="form-label">Email</label>
      <input type="email" name="email" required  id="inputEmail" @class([
                "form-control",
                "is-valid" => $errors->any() && !$errors->getBag('default')->has('email'),
                "is-invalid" => $errors->any() && $errors->getBag('default')->has('email')
              ])
        value="{{ old('email') }}"
      >
      @if($errors->any() && $errors->getBag('default')->has('email'))
        <div class="invalid-feedback">
          @foreach($errors->getBag('default')->get('email') as $error)
            <p>{{$error}}</p>
          @endforeach
        </div>
      @endif
    </div>
  @endif
  <div class="mb-3">
    <label for="inputName" class="form-label">Nombre de usuario</label>
    <input autofocus type="text" placeholder="Usuario" maxlength="30" id="inputName" name="name" required aria-describedby="nameHelp" @class([
                "form-control",
                "is-valid" => $errors->any() && !$errors->getBag('default')->has('name'),
                "is-invalid" => $errors->any() && $errors->getBag('default')->has('name')
              ])
      value="{{ old('name') }}"
    >
    @if($tipo=='registro')
      <div id="nameHelp" class="form-text">Tu nombre para acceder a la aplicación. Debe ser único.</div>
    @endif
    @if($errors->any() && $errors->getBag('default')->has('name'))
      <div class="invalid-feedback">
        @foreach($errors->getBag('default')->get('name') as $error)
          <p>{{$error}}</p>
        @endforeach
      </div>
    @endif
  </div>
  <div class="mb-3">
    <label for="inputPassword" class="form-label">Contraseña</label>
    <input type="password" name="password" id="inputPassword" required aria-describedby="passwordHelp" class="form-control" placeholder="Contraseña">
    @if($tipo=='registro')
      <div id="passwordHelp" class="form-text">Debe tener al menos 6 caracteres con letras mayúsculas, minúsculas y números.</div>
    @endif
    @if($errors->any() && $errors->getBag('default')->has('password'))
      <div class="invalid-feedback">
        @foreach($errors->getBag('default')->get('password') as $error)
          <p>{{$error}}</p>
        @endforeach
      </div>
    @endif
  </div>
  @if($tipo=='login')
    <div class="mb-3">
    <button class ="btn" data-bs-toggle="modal" data-bs-target="#ventanaModal" id='forgoten'>¿Has olvidado tu contraseña?</button><br>
      <input type="checkbox" class="form-check-input" id="checkRemember">
      <label class="form-check-label" for="checkRemember" name="remember">Mantener la sesión iniciada</label>
    </div>

    <div class="modal" id="ventanaModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 id="tituloVentana">¿Has olvidado tu contraseña?</h5>
                        <button class="btn btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                      <p>Introduce tu email para recibir un correo y restablecer tu contraseña</p>
                      <input autofocus type="email" placeholder='nombre@mail.com' id='emailForgoten'>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success" type="button" onclick="(function()
                        {
                          var email = document.getElementById('emailForgoten').value;
                          sendMail(email);
                        })();return false;">Aceptar</button>
                    </div>
                    <div class="alert alert-success" id='success'>
                      Accede al enlace que te hemos enviado por email para recuperar tu contraseña
                    </div>
                    <div class="alert alert-danger" id='failure'>
                      Ha habido un error al enviar el email. Inténtalo de nuevo más tarde.
                    </div>
                </div>
            </div>
        </div>

    <div id='modalPassword' class="modal fade">
      <h4>¿Has olvidado tu contraseña?</h4>
      <p>Introduce tu email para recibir un correo y restablecer tu contraseña</p>
      <input type="email" placeholder='nombre@mail.es'>
      <button>Enviar</button>
    </div>

  
  @endif
  <button type="submit" class="btn btn-primary" id="btnenviar">Enviar</button>
</form>

<script>
  function sendMail(email)
  {
    //abrir la página de enviar email con el email que se ha puesto
    var emailArray = email.split('@');
    var nombre = emailArray[0];
    var direccion = emailArray[1];
    url = "/sendmail/" + nombre + "/" + direccion;
    window.open(url, "_blank");
   

    //(en ajax) buscar en la ddbb el token que le corresponde al email que se ha enviado
    //(en ajax) se envía el email que tenga el token. El email tiene que tener un enlace que redirija con el token y el email
    //if se ha enviado bien, a #success ponerle el display block. Else ponerle a #failure el display block

  }
  
</script>