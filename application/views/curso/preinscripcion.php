<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Preinscripcion</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Inicio</a></li>
            <li class="breadcrumb-item"><a href="">Cursos</a> </li>
            <li class="breadcrumb-item active">Preinscripcion</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header ui-sortable-handle" style="cursor: move;">
              <h3 class="card-title">
                <i class="fas fa-chart-pie mr-1"></i>
                Lista
              </h3>

              <div class="card-tools">
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                  <label class="btn btn-sm btn-dark active">
                    <input type="radio" name="options" id="option2" data-card-widget="maximize"> <i class="fas fa-expand"></i>
                  </label>
                </div>

              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">

                  <form class="ocform form-inline">
                    <div class="form-group">
                      <label for="rango">Desde / Hasta: </label>
                      <input class="form-control" type="text" id="rango" name="rango" />
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control" name="search[value]" id="filtro" placeholder="Buscar" value="">
                    </div>


                  </form>
                </div>

                <div class="col-md-12">
                  <div class="table-responsive">
                    <?php echo genDataTable('mitabla', $columns, true, true); ?>
                  </div>

                </div>


              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>