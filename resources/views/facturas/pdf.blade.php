<style> 

@import url(https://fonts.googleapis.com/css?family=Roboto:100,300,400,900,700,500,300,100);
*{
  margin: 0;
  box-sizing: border-box;

}
body{
  background: #E0E0E0;
  font-family: 'Roboto', sans-serif;
  background-repeat: repeat-y;
  background-size: 100%;
}
h1{
  font-size: 1.5em;
  color: #222;
}
h2{font-size: .9em;}
h3{
  font-size: 1.2em;
  font-weight: 300;
  line-height: 2em;
}
p{
  font-size: .7em;
  color: #666;
  line-height: 1.2em;
}

#headerimage{
  z-index:-1;
  position:relative;
  top: -50px;
  height: 350px;

  -webkit-box-shadow:inset 0 2px 4px rgba(0,0,0,.15), inset 0 -2px 4px rgba(0,0,0,.15);
	-moz-box-shadow:inset 0 2px 4px rgba(0,0,0,.15), inset 0 -2px 4px rgba(0,0,0,.15);
	box-shadow:inset 0 2px 4px rgba(0,0,0,.15), inset 0 -2px 4px rgba(0,0,0,.15);
  overflow:hidden;
  background-attachment: fixed;
  background-size: 1920px 80%;
  background-position: 50% -90%;
}
#invoice{
  position: relative;
  top: -290px;
  margin: 0 auto;
  width: 700px;
  background: #FFF;
}

[id*='invoice-']{ /* Targets all id with 'col-' */
  border-bottom: 1px solid #EEE;
  padding: 30px;
}

#invoice-top{min-height: 120px;}
#invoice-mid{min-height: 120px;}
#invoice-bot{ min-height: 250px;}

.logo{
  float: left;
	height: 60px;
	width: 60px;
	background-size: 60px 60px;
}
.info{
  display: block;
  float:left;
  margin-left: 20px;
}
.title{
  float: right;
}
.title p{text-align: right;}
#project{margin-left: 52%;}
table{
  width: 100%;
  border-collapse: collapse;
}
td{
  padding: 5px 0 5px 15px;
  border: 1px solid #EEE
}
.tabletitle{
  padding: 5px;
  background: #EEE;
}
.service{border: 1px solid #EEE;}
.item{width: 50%;}
.itemtext{font-size: .9em;}

#legalcopy{
  margin-top: 30px;
}
form{
  float:right;
  margin-top: 30px;
  text-align: right;
}



</style>
@foreach($factura_all as $factura)
@endforeach
@foreach($factura_cliente as $cliente)
@endforeach


  <div id="headerimage"></div>
  <div id="invoice" class="effect2">
    
    <div id="invoice-top">
      <div class="info">
        <h2>Nombre del Cliente: {{$cliente->nombre_cliente}}</h2>
        <p> <strong> Documento del Cliente: </strong>{{$cliente->documento_identidad}}</br>
        </p>
      </div><!--End Info-->
      <div class="title">
        <h1>FACTURA #{{$factura->id_factura}}</h1>
        <p> <b> Fecha de Creacion: </b>{{ \Carbon\Carbon::parse($factura->created_at)->formatLocalized('%d %B %Y');}}</br>
        <p> <b> Hora de Creacion: </b>{{ \Carbon\Carbon::parse($factura->created_at)->formatLocalized('%I:%M %p');}}</br>

        </p>
      </div><!--End Title-->
    </div><!--End InvoiceTop-->
    
    <div id="invoice-bot">
      
      <div id="table">
        <table>
          <tr class="tabletitle">
            <td class="item"><h2>Productos</h2></td>
            <td class="Hours"><h2>Cantidad</h2></td>
            <td class="Rate"><h2>Precio</h2></td>
            <td class="subtotal"><h2>Total Unitario</h2></td>
          </tr>
            
          @foreach($factura_all as $factura)
          <tr class="service">
            <td class="tableitem"><p class="itemtext">{{$factura->nombre}}</p></td>
            <td class="tableitem"><p class="itemtext">{{$factura->cantidad}}</p></td>
            <td class="tableitem"><p class="itemtext">${{$factura->precio}}</p></td>
            <td class="tableitem"><p class="itemtext">${{$factura->total_producto}}</p></td>
          </tr>
          @endforeach

          <tr class="tabletitle">
            <td></td>
            <td></td>
            <td class="Rate"><h2>Total</h2></td>

            <td class="payment"><h2>${{$factura->total}}</h2></td>
    
          </tr>
        </table>
      </div><!--End Table-->
    
      
    </div><!--End InvoiceBot-->
  </div><!--End Invoice-->
