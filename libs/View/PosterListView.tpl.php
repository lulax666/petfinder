<?php
$this->assign('title','FIND MY PET | Posters');
$this->assign('nav','posters');
$this->display('_Header.tpl.php');
?>

<script type="text/javascript">
    $LAB.script("libs/View/scripts/posters.js").wait(function(){
        $(document).ready(function(){
            page.init();
        });
        // hack for IE9 which may respond inconsistently with document.ready
        setTimeout(function(){
            if (!page.isInitialized) page.init();
        },1000);
    });
</script>

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
<a href="poster/nuevo" class="md-btn md-fab md-fab-bottom-right pos-fix blue waves-effect"><i class="mdi-content-add i-24"></i></a>
<!-- underscore template for the collection -->
<script type="text/template" id="posterCollectionTemplate">
    <%=  view.getPaginationHtml(page) %>

    <div class="md-whiteframe-z0 bg-white">
        <ul class="nav nav-md nav-tabs nav-lines b-info">
            <li class="active">
                <a href="" data-toggle="tab" data-target="#tab_1" aria-expanded="true">Publicaciones</a>
            </li>
            <li class="">
                <a href="" data-toggle="tab" data-target="#tab_2" aria-expanded="false">Tabla</a>
            </li>
        </ul>
        <div class="tab-content p m-b-md b-t b-t-2x">
            <div role="tabpanel" class="tab-pane animated fadeIn active" id="tab_1">
                <div class="row">
                    <% items.each(function(item) { %>
                        <div class="col-sm-3">
                            <div class="panel panel-card">
                                <div class="item">
                                    <% if (_.escape(item.get('imagen')) != '') { %>
                                        <img src="<%= _.escape(item.get('imagen') || '') %>" class="w-full r-t" style="max-height: 250px" >
                                    <% }else{ %>
                                        <span class="fa-stack fa-lg">
                                <i class="fa fa-camera fa-stack-1x"></i>
                                <i class="fa fa-ban fa-stack-2x text-danger"></i>
                            </span>
                                    <% } %>
                                </div>
                                <button md-ink-ripple="" class="md-btn md-fab md-raised indigo m-r md-fab-offset pull-right waves-effect"><i class="fa fa-heart"></i></button>
                                <div class="p">
                                    <h3><%= _.escape(item.get('mascota_nombre') || '') %></h3>
                                    <h4><%= _.escape(item.get('tipoMascota_nombre')+ ' ' + item.get('mascota_tamano')+ ' ' +item.get('raza_nombre') || '') %></h4>
                                    <h5>Dueño: <%= _.escape(item.get('usuario_nombre') || '') %></h5>
                                    <h5>Genero: <%= _.escape(item.get('mascota_genero') || '') %></h5>
                                    <h5>Color: <%= _.escape(item.get('mascota_color') || '') %></h5>
                                    <p class="text-sm text-muted">Descripcion: <%= _.escape(item.get('descripcion') || '') %></p>
                                    <div class="text-muted-dk">Publicado el <%= _.escape(item.get('fecha')+ ' ' +item.get('hora') || '') %></div>
                                </div>
                            </div>
                        </div>
                    <% }); %>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane animated fadeIn" id="tab_2">
                <div class="table-responsive">
                    <table class="collection table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th id="header_Pkposter">ID Poster<% if (page.orderBy == 'Pkposter') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
                                <th id="header_Fkusuario">Usuario<% if (page.orderBy == 'Fkusuario') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
                                <th id="header_Fkmascota">Mascota<% if (page.orderBy == 'Fkmascota') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
                                <th id="header_Latitud">Latitud<% if (page.orderBy == 'Latitud') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
                                <th id="header_Longitud">Longitud<% if (page.orderBy == 'Longitud') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
                                <th id="header_Descripcion">Descripcion<% if (page.orderBy == 'Descripcion') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
                                <th id="header_Fecha">Fecha<% if (page.orderBy == 'Fecha') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
                                <th id="header_Hora">Hora<% if (page.orderBy == 'Hora') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
                                <th id="header_Imagen">Imagen<% if (page.orderBy == 'Imagen') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
                            </tr>
                        </thead>
                        <tbody>
                            <% items.each(function(item) { %>
                                <tr id="<%= _.escape(item.get('pkposter')) %>">
                                    <td><%= _.escape(item.get('pkposter') || '') %></td>
                                    <td><%= _.escape(item.get('usuario_nombre') || '') %></td>
                                    <td><%= _.escape(item.get('mascota_nombre') || '') %></td>
                                    <td><%= _.escape(item.get('latitud') || '') %></td>
                                    <td><%= _.escape(item.get('longitud') || '') %></td>
                                    <td><%= _.escape(item.get('descripcion') || '') %></td>
                                    <td><%= _.escape(item.get('fecha') || '') %></td>
                                    <td><%= _.escape(item.get('hora') || '') %></td>
                                    <td>
                                        <% if (_.escape(item.get('imagen')) != '') { %>
                                            <img src="<%= _.escape(item.get('imagen') || '') %>" width="100px" style="border-radius: 5px">
                                        <% }else{ %>
                                            (Sin imagen)
                                        <% } %>
                                    </td>
                                </tr>
                            <% }); %>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</script>

<!-- underscore template for the model -->
<script type="text/template" id="posterModelTemplate">
    <% if (_.escape(item.get('imagen')) != '') { %>
        <div class="row">
            <div class="col-xs-12 text-center">
                <a href="<%= _.escape(item.get('imagen') || '') %>" target="_blank">
                    <img width="200px" src="<%= _.escape(item.get('imagen') || '') %>" style="border-radius: 25px"/>
                </a>
            </div>
        </div>
        <br>
    <% } %>
    <form onsubmit="return false;">
        <fieldset>
            <span class="hidden" id="pkposter"><%= _.escape(item.get('pkposter') || '') %></span>
        </fieldset>
    </form>

    <!-- delete button is is a separate form to prevent enter key from triggering a delete -->
    <form id="deletePosterButtonContainer" class="form-horizontal" onsubmit="return false;">
        <fieldset>
            <div class="control-group dropdown">
                <button type="button" class="btn btn-fw btn-danger waves-effect" data-toggle="dropdown" aria-expanded="true"><i class="fa fa-trash fa-fw"></i> Eliminar</button>
                <ul class="dropdown-menu animated fadeIn">
                    <li><a href="#" id="confirmDeletePosterButton"><i class="fa fa-check"></i></a></li>
                    <li><a href="#" id="cancelDeletePosterButton"><i class="fa fa-times"></i></a></li>
                </ul>
            </div>
        </fieldset>
    </form>
</script>

<!-- modal edit dialog -->
<div class="modal fade" id="posterDetailDialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <a class="close" data-dismiss="modal">&times;</a>
                <h3>
                    <i class="icon-edit"></i> Editar Poster
                    <span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
                </h3>
            </div>
            <div class="modal-body">
                <div id="modelAlert"></div>
                <div id="posterModelContainer"></div>
            </div>
            <div class="modal-footer">
                <button md-ink-ripple="" class="btn btn-fw btn-default waves-effect waves-effect" data-dismiss="modal"><i class="fa fa-ban fa-fw"></i> Cancelar</button>
            </div>
        </div>
    </div>
</div>

<div id="collectionAlert"></div>

<div id="posterCollectionContainer" class="collectionContainer">
</div>


<?php
$this->display('_Footer.tpl.php');
?>