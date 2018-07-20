<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <title> Acción onclick en js </title>       
    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>

  </head>
  <body>
<div id='pagina'>
    <div id='mensaje'>&nbsp;</div>

    <form id='formulario' action='#' method='post'>
        <input type='text' id='operando1' name='operando1' value='' size='4' maxlength='4' />

        <select id='operador' name='operador'>
            <option value='SU'>+</option>
            <option value='RE'>-</option>
            <option value='MU'>*</option>
            <option value='DI'>/</option>
        </select>

        <input type='text' id='operando2' name='operando2' value='' size='4' maxlength='4' />

        <input type='button' id='igual' value='=' />

        <span id='resultado'>&nbsp;</span>
    </form>
 </div>
  </body>
</html>