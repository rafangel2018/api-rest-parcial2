<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API - BovinoWeb</title>
    <link rel="stylesheet" href="assets/estilo.css" type="text/css">
</head>
<body>

<div  class="container">
    <h1>Api BovinosWeb</h1>
    <div class="divbody">
        <h3>Auth - login</h3>
        <code>
           POST  /auth
           <br>
           {
               <br>
               "usuario" :"",  -> REQUERIDO
               <br>
               "password": "" -> REQUERIDO
               <br>
            }
        
        </code>
    </div>      
    <div class="divbody">   
        <h3>Bovinos</h3>
        <code>
           GET  /bovinos?page=$numeroPagina
           <br>
           GET  /bovinos?id=$idPaciente
        </code>

        <code>
           POST  /bovinos
           <br> 
           {
            <br> 
               "raza" : "",               -> REQUERIDO
               <br> 
               "fecha" : "",                  -> REQUERIDO
               <br> 
               "estado":"",                 -> REQUERIDO
               <br> 
               "preñado" :"",             -> REQUERIDO
               <br>  
               "peso" : "",        -> REQUERIDO
               <br>        
               "corporal" : "",       -> REQUERIDO
               <br>       
               "nacimiento" : "",      -> REQUERIDO
               <br>         
               "token" : ""                 -> REQUERIDO        
               <br>       
           }

        </code>
        <code>
           PUT  /bovinos
           <br> 
           {
            <br> 
            "raza" : "",               -> REQUERIDO
               <br> 
               "fecha" : "",                  -> REQUERIDO
               <br> 
               "estado":"",                 -> REQUERIDO
               <br> 
               "preñado" :"",             -> REQUERIDO
               <br>  
               "peso" : "",        -> REQUERIDO
               <br>        
               "corporal" : "",       -> REQUERIDO
               <br>       
               "nacimiento" : "",      -> REQUERIDO
               <br>         
               "token" : ""                 -> REQUERIDO        
               <br>          
               "Id" : ""   -> REQUERIDO
               <br>
           }

        </code>
        <code>
           DELETE  /bovinos
           <br> 
           {   
               <br>    
               "token" : "",                -> REQUERIDO        
               <br>       
               "Id" : ""   -> REQUERIDO
               <br>
           }

        </code>
    </div>


</div>
    
</body>
</html>

