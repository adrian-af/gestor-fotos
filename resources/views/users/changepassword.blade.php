@extends('layout')
@section('content')

<style>
    #form1
    {
        display: flex;
        flex-direction: column;
        text-align: center;
    }
    #form1 > *
    {
        margin: 5px;
    }
    .containerPass
    {
        display: inline-block;
        border: 1px solid grey;
        border-radius: 5px;
        margin: .2em auto !important;
        padding: 3px;
    }
    .containerButton
    {
        display: inline-block;
        margin: .2em auto !important;
        padding: .1em 5em;
    }
    input[type=password], input[type=text]
    {
        border: none;
    }
    input:focus
    {
        outline: none;
    }
    .see
    {
        display: none;
    }
</style>
<form target="_blank" id="form1">
        <h1>
            Recuperar contraseña
        </h1>
        <p>Introduce una contraseña nueva para recuperar el acceso a la cuenta vinculada a </p>
        <div class="containerPass">
            <input type="password" id="pass1" placeholder="Introduce tu nueva contraseña" size="30">
            <img src="https://img.icons8.com/ios-glyphs/30/000000/hide.png" width="15px" height="15px" onclick="toggleeye('1')" class='notsee' id='notsee1'>
            <img src="https://img.icons8.com/ios-glyphs/30/000000/visible--v1.png" width="15px" height="15px" onclick="toggleeye('1')" class='see' id='see1'>

        </div>
        <div class="containerPass">
            <input type="password" id="pass2" placeholder="Repite tu nueva contraseña" size="30">
            <img src="https://img.icons8.com/ios-glyphs/30/000000/hide.png" width="15px" height="15px" onclick="toggleeye('2')" class='notsee' id='notsee2'>
            <img src="https://img.icons8.com/ios-glyphs/30/000000/visible--v1.png" width="15px" height="15px" onclick="toggleeye('2')" class='see' id='see2'>
        </div>
        <button class='btn btn-primary containerButton'>Recuperar contraseña</button>
    </form>
    <script>
        var dir = ".com";
        var url = "https://stackoverflow" + dir;
        document.getElementById("form1").setAttribute("action", url);
        function toggleeye(id)
        {
            var input = "pass" + id;
            var fotoSee = "see" + id;
            var fotoNotSee = "notsee" + id;
            var tipo = document.getElementById(input).type;
            if(tipo == "password")
            {
                
                document.getElementById(input).type = "text";
                document.getElementById(fotoSee).style.display = "inline-block";
                console.log("displaySee");
                document.getElementById(fotoNotSee).style.display = "none";
            }
            else
            {
                document.getElementById(input).type = "password";
                console.log("displaynotsee");
                document.getElementById(fotoSee).style.display = "none";
                document.getElementById(fotoNotSee).style.display = "inline-block";
            }
            
            var displaySee = document.getElementById(fotoSee).style.display;
            console.log(displaySee);
            var displayNotSee = document.getElementById(fotoNotSee).style.display;
            console.log(displayNotSee);
           
        }
    </script>

@endsection