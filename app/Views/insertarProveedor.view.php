<div class="card-body">
    <!--<form action="./?sec=formulario" method="post">                   -->
    <form method="get" action="/bdoProveedores">
        <div class="row">

            <h2>Alta de proveedores</h2>
            <div class="mb-3 col-sm-6"></div>
            <div class="mb-3 col-sm-6">
                <label for="tipo" >Cif:</label>
                <input type="text" id="cif" name="cif" value="">
            </div>
            <div class="mb-3  col-sm-6">
                <label for="tipo" >Codigo:</label>
                <input type="text" id="codigo" name="codigo" value="">
            </div>
            <div class="mb-3  col-sm-6">
                <label for="tipo">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="">
            </div>
            <div class="mb-3  col-sm-6">
                <label for="tipo">Direccion:</label>
                <input type="text" id="direccion" name="direccion" value="">
            </div>
            <div class="mb-3  col-sm-6">
                <label for="tipo">Pagina web:</label>
                <input type="text" id="website" name="website" value="">
            </div>
            <div class="mb-3  col-sm-6">
                <label for="tipo">Pais:</label>
                <input type="text" id="pais" name="pais" value="">
            </div>
            <div class="mb-3  col-sm-6">
                <label for="tipo">Email:</label>
                <input type="text" id="email" name="email" value="">
            </div>
            <div>
            </div>
            <div class="mb-3">
                <a href="." value="" name="reiniciar" class="btn btn-danger">Reiniciar filtros</a>
                <input type="submit" name="añadir" value="Añadir" class="btn btn-primary"/>
                <a href="/bdoProveedores" class="btn btn-info">Volver a proveedores</a>
            </div>
        </div>
    </form>
</div>
