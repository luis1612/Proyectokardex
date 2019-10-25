@extends ('layouts.admin')
@section ('contenido')

<main role="main">

      <!-- Main jumbotron for a primary marketing message or call to action -->
      <div class="jumbotron">
        <div class="container">
          <h1 class="display-3">SisKardex V1.0 PRO!</h1>
          <p>Sabemos que en el día a día no es fácil llevar el control de tu mercadería. Productos que se pierden, los datos en las planillas que no coinciden con la realidad, clientes decepcionados porque no encuentran lo que están buscando.  Mucho trabajo, pocos resultados. Por esa razón estuvimos trabajando por y para los pequeños y medianos comercios, sabemos exactamente lo que necesitas: un programa que te simplifique la vida!
          </p>
        </div>
      </div>

      <div class="container">
        <!-- Example row of columns -->
        <div class="row">
          <div class="col-md-5">
            <h2>METROS A UNIDADES:</h2>
            <p>  El metraje se divide por los Metros que contega la caja y luego ese resultado se multiplica por las Unidad de embalaje de la caja (Ejemplo: 1.26/1.89x9= 5.99999,  dando como resultado un aproximado de 6 Unidades). Tener en cuenta que los diferentes formatos entre pisos, paredes, fachadas, porcelanatos. </p>
          </div>
          <div class="col-md-5">
            <h2>UNIDADES A METROS:</h2>
            <p> El metraje los multiplicamos por los Metros que contega la caja y luego ese resultado lo dividimos por las Unidades de embalaje de la caja (Ejemplo: tomaremos '6 unidades' entonces 6 x 1.89 / 9 = 1.26, dando como resultado 1.26 Metros ) </p>
          </div>
          <div class="col-md-5">
            <h2>CAJAS A METROS:</h2>
            <p> La cantidad de cajas se multiplica por los metros que contega la medida de la caja.(EJEMPLO: Son 20 cajas y la medida es de "60x60-1.80x5" entonces seria 20 x 1.80 = 36 metros el resultado equivalente a 20 cajas en el formato 60x60).</p>
          </div>
          <div class="col-md-5">
            <h2>CAJAS MÁS UNIDADES:</h2>
            <p>Se divide el metraje por los metros que contega la medida de la caja (Eso da la cantidad de cajas totales), luego se resta ese resultado y se multiplica por las Unidades de embalaje de la caja (Ejemplo: 50 mts de una piso el cual tiene formato de 33x33 -- 1.60x14 entonces 50 / 1.60 = 31.25  '31 serian  la cantidad total de cajas ', restamos los 31 seria  igual a 0.25 y ese resultado lo multiplicamos por las unidades de embalaje que serian 14 y da como resultado 3.5 'siendo 3 la cantidad de unidades' como resultado total 31 cajas + 3 unidades equivalen a 50 metros en formato de 33x33.) </p>
            <br>
             <i class="fa fa-file-pdf-o fa-5x" aria-hidden="true"></i>
            <a href="imagenes/articulos/MUSP_SISKARDEX_V1.0_Manual_Usuario-convertido.pdf "><font size="5">  DESCARGAR EL MANUAL PROVISIONAL</font></a>
          </div>
          <div class="col-md-5">
            <h2>TECNOLOGÍA CORONA</h2>
            <center>
               <img src="imagenes/tecorona.png" alt="tecorona" BORDER=0 ALIGN="MIDDLE" height="450" width="500">
            </center>
          </div>
          <br>
          <div class="row" >
            <div class="col-lg-9 col-md-10 col-sm-10 col-xs-10">
              <div class="table-responsive">
                <table  id="testTable" class="table table-striped table-bordered table-condensed table-hover">
            <thead class="thead-dark">
              <tr>
                <th scope="col">COMBO</th>
                <th scope="col">SANITARIO</th>
                <th scope="col">LAVAMANOS</th>
                <th scope="col">PEDESTAL / SEMIPEDESTAL</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">1</th>
                <td>LAGUNA</td>
                <td>MILANO / ACUACER</td>
                <td>ACUACER / VERONA</td>
              </tr>
              <tr>
                <th scope="row">2</th>
                <td>HAPPY</td>
                <td>HAPPY</td>
                <td>SEMIPED HAPPY</td>
              </tr>
              <tr>
                <th scope="row">3</th>
                <td>AQUAPRO RD-ALG</td>
                <td>AQUAPRO / GANAMAX</td>
                <td>SEMIPED GANAMAX</td>
              </tr>
              <tr>
                <th scope="row">4</th>
                <td>AVANTI PLUS</td>
                <td>AVANTI</td>
                <td>AVANTI</td>
              </tr>
              <tr>
                <th scope="row">5</th>
                <td>SMART RD-ALOG</td>
                <td>AVANTI</td>
                <td>AVANTI</td>
              </tr>
              <tr>
                <th scope="row">6</th>
                <td>MONTECARLO RD-ALOG</td>
                <td>AVANTI</td>
                <td>AVANTI</td>
              </tr>
              <tr>
                <th scope="row">7</th>
                <td>MANANTIAL PLUS</td>
                <td>MANANTIAL</td>
                <td>MANANTIAL</td>
              </tr>
            </tbody>
          </table>
            </div>
          </div>    
        </div>
        </div>
        </div>
              <center>
              <video src="imagenes/1.mp4" width="540" height="480"></video>
            </center>
        <hr>  
      </div> <!-- /container -->

</main>
@endsection


