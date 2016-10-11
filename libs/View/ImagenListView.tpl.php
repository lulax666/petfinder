<?php
$this->assign('title','FIND MY PET | Imagenes');
$this->assign('nav','imagenes');
$this->display('_Header.tpl.php');
?>

<script type="text/javascript">
    $LAB.script("libs/View/scripts/imagenes.js").wait(function(){
        $(document).ready(function(){
            page.init();
        });

        // hack for IE9 which may respond inconsistently with document.ready
        setTimeout(function(){
            if (!page.isInitialized) page.init();
        },1000);
    });
</script>

<button id="newImagenButton" class="md-btn md-fab md-fab-bottom-right pos-fix blue waves-effect"><i class="mdi-content-add i-24"></i></button>
<div class="row">
    <div class="col-xs-4">
        <h3><?php echo strtoupper($this->nav) ?></h3>
    </div>
    <div class="col-xs-4 col-xs-offset-4">
        <div class="input-group">
            <div class="md-form-group float-label ">
                <input class="md-input" id='filter' type="text"/>
                <label> Buscar</label>
            </div>
            <span class="input-group-btn">
                <button class="md-btn md-flat text-primary waves-effect" type="button"><i class="mdi-action-search i-24"></i></button>
            </span>
        </div>
    </div>
</div>

<!-- underscore template for the collection -->
<script type="text/template" id="imagenCollectionTemplate">
    <%=  view.getPaginationHtml(page) %>
    <div class="table-responsive">
        <table class="collection table table-bordered table-hover">
            <thead>
            <tr>
                <th id="header_Pkimagen">ID imagen<% if (page.orderBy == 'Pkimagen') { %> <i class='fa fa-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
                <th id="header_Ruta">Ruta<% if (page.orderBy == 'Ruta') { %> <i class='fa fa-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
                <th>Imagen</th>
                <th id="header_Fkposter">ID Poster<% if (page.orderBy == 'Fkposter') { %> <i class='fa fa-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
            </tr>
            </thead>
            <tbody>
            <% items.each(function(item) { %>
                <tr id="<%= _.escape(item.get('pkimagen')) %>">
                    <td><%= _.escape(item.get('pkimagen') || '') %></td>
                    <td><%= _.escape(item.get('ruta') || '') %></td>
                    <td class="text-center">
                        <% if (_.escape(item.get('ruta')) != '') { %>
                            <a href="<%= _.escape(item.get('ruta') || '') %>" target="_blank">
                                <img width="50px" src="<%= _.escape(item.get('ruta') || '') %>" style="border-radius: 5px"/>
                            </a>
                        <% }else{ %>
                            <span class="fa-stack fa-lg">
								<i class="fa fa-camera fa-stack-1x"></i>
								<i class="fa fa-ban fa-stack-2x text-danger"></i>
							</span>
                        <% } %>
                    </td>
                    <td><%= _.escape(item.get('fkposter') || '') %></td>
                </tr>
            <% }); %>
            </tbody>
        </table>
    </div>
</script>

<!-- underscore template for the model -->
<script type="text/template" id="imagenModelTemplate">
    <% if (_.escape(item.get('ruta')) != '') { %>
        <div class="row">
            <div class="col-xs-12 text-center">
                <a href="<%= _.escape(item.get('ruta') || '') %>" target="_blank">
                    <img width="200px" src="<%= _.escape(item.get('ruta') || '') %>" style="border-radius: 25px"/>
                </a>
            </div>
        </div>
        <br>
    <% } %>
    <form onsubmit="return false;">
        <fieldset>
            <span class="hidden" id="pkimagen"><%= _.escape(item.get('pkimagen') || '') %></span>
            <div class="row">
                <div class="col-xs-6">
                    <div class="form-group">
                        <label>Ruta</label>
                        <input type="text" class="form-control" id="ruta" placeholder="Ruta" value="<%= _.escape(item.get('ruta') || '') %>">
                        <span class="help-inline"></span>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="form-group">
                        <label>Poster</label>
                        <select class="form-control" id="fkposter"></select>
                        <span class="help-inline"></span>
                    </div>
                </div>
            </div>
        </fieldset>
    </form>

    <!-- delete button is is a separate form to prevent enter key from triggering a delete -->
    <form id="deleteImagenButtonContainer" class="form-horizontal" onsubmit="return false;">
        <fieldset>
            <div class="control-group dropdown">
                <button type="button" class="btn btn-fw btn-danger waves-effect" data-toggle="dropdown" aria-expanded="true"><i class="fa fa-trash fa-fw"></i> Eliminar</button>
                <ul class="dropdown-menu animated fadeIn">
                    <li><a href="#" id="confirmDeleteImagenButton"><i class="fa fa-check"></i></a></li>
                    <li><a href="#" id="cancelDeleteImagenButton"><i class="fa fa-times"></i></a></li>
                </ul>
            </div>
        </fieldset>
    </form>
</script>

<!-- modal edit dialog -->
<div class="modal fade" id="imagenDetailDialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <a class="close" data-dismiss="modal">&times;</a>
                <h3>
                    <i class="icon-edit"></i> Editar Imagen
                    <span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
                </h3>
            </div>
            <div class="modal-body">
                <div id="modelAlert"></div>
                <div id="imagenModelContainer"></div>
            </div>
            <div class="modal-footer">
                <button md-ink-ripple="" class="btn btn-fw btn-default waves-effect waves-effect" data-dismiss="modal"><i class="fa fa-ban fa-fw"></i> Cancelar</button>
                <button md-ink-ripple="" id="saveImagenButton" class="btn btn-fw btn-success waves-effect waves-effect"><i class="fa fa-floppy-o fa-fw"></i> Guardar</button>
            </div>
        </div>
    </div>
</div>

<div id="collectionAlert"></div>

<div id="imagenCollectionContainer" class="collectionContainer">
</div>


<?php
$this->display('_Footer.tpl.php');
?>