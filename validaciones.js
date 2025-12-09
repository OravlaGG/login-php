/*

Validaciones para el formulario
Álvaro Gómez González

*/

document.getElementById('formT').addEventListener("submit",function(event){
    
    event.preventDefault();

    if(validarFormulario())
    {
        document.getElementById('formT').submit();//impide que envie nada al php
    }
});

document.getElementById('pass').addEventListener("change",function(){
    limpiaError('pass');
});
document.getElementById('identi').addEventListener("change",function(){
    limpiaError('pass');
});

function validarFormulario()
{
    let pass = document.getElementById('pass').value;
    let identi = document.getElementById('identi').value;
    let correcto = true;
    var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[$@$!%*?&\.,])([A-Za-z\d$@$!%*?&]|[^ ]){8,15}$/;

    if (Number.isNaN(pass))
    {
        marcarError('pass','La contraseña no puede estar vacia');
        correcto = false;
    }
    else
    {
        if(!regex.exec(pass))
        {
            marcarError('pass','Formato de contraseña incorrecto');
            correcto = false;

        }
    }

    if (Number.isNaN(identi) || pass.length < 6 || pass.length > 15)
    {
        marcarError('identi','El usuario no puede estar vacio y debe ser entre 6 a 14 caracteres');
        correcto = false;
    }

    return correcto;
}

function marcarError(id,msg)
{
    document.getElementById(id).style.borderColor="red";
    document.getElementById(id+'Help').innerHTML = msg;
    document.getElementById(id+'Help').style.visibility="visible";
}

function limpiaError(id)
{
    document.getElementById(id).style.borderColor="#dee2e6";
    document.getElementById(id+'Help').style.visibility="hidden";
}