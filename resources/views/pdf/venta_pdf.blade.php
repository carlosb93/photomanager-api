@extends('layouts.pdf', ['title' => $data['title'], 'logo' => $data['logo'], 'empresa' => $empresa , 'codigo' => 'Ventas-005'])
{{-- <link href="{{asset('css/style-reports.css')}}" rel="stylesheet"> --}}
@section('content')
<div style="width: 100%;margin-top: -15px">

<div class="card" >
<div class="card-header" style="margin-top: 0px">
    <div style="margin-top: 5px; font-size: 12px !important;margin-right: 55%;width: 70%" class="pull-right heading">
        <div>
            Comentarios:
        </div>

    </div>
    <h4 class="card-title" style="font-size: 12px;margin-top: -5px;width: 35%">ID del trámite: {{ $data['tramiteId'] }} </h4>
</div>
<div class="card-body collapse show" style="margin-top: 20px; padding-bottom: 2px">
    <div class="table-responsive">
        <table class="table product-overview" cellspacing="0" style="margin-top:35px; border-color: #ffffff;width: 100%; border-top: 0px; font-size: 0.8em;" border="0px">
            <tr>
                <td class="heading-table"><strong>Marca:</strong></td>
                <td> {{ $fullResponse[0]->nombremarca }} </td>
                <td class="heading-table"><strong>Modelo:</strong></td>
                <td>{{ $fullResponse[0]->nombremodeloauto }}</td>
                <td class="heading-table "><strong>Versión:</strong></td>
                <td>{{ $fullResponse[0]->nombreversionauto }}</td>
                <td class="heading-table"><strong>Año:</strong></td>
                <td>{{ $fullResponse[0]->anno }}</td>
            </tr>
            <tr>
                <td class="heading-table"><strong>Color:</strong></td>
                <td> {{ $fullResponse[0]->nombrecolorauto }} </td>
                <td class="heading-table"><strong>Placas:</strong></td>
                <td>{{ $fullResponse[0]->placas }}</td>
                <td class="heading-table"><strong>VIN:</strong></td>
                <td style="width: 35%"> {{ $fullResponse[0]->vin }} </td>
                <td class="heading-table" style="width: 12%"><strong>Capacidad:</strong></td>
                <td>{{ $fullResponse[0]->capacidadpasajero }}</td>

            </tr>
        </table>
    </div>
</div>
</div>

<div style="margin-top: -35px">
<div class="card" >
    <div class="card-header" style="margin-top:0px">

        <h4 class="card-title" style="font-size: 12px;width: 100%;text-align: center"><strong> Proveedor del Vehículo </strong></h4>
    </div>
    <div class="card-body collapse show" style="margin-top: 20px; padding-bottom: 2px">
        <div class="table-responsive">
            <table class="table product-overview" cellspacing="0" style="margin-top:30px; border-color: #ffffff;width: 100%; border-top: 0px; font-size: 0.8em;" border="0px">
                <tr>
                    <td style="text-align: left;width: 25%" class="heading-table">
                       <strong>Nombre o Razón Social:</strong>
                    </td>
                    <td style="text-align: left;width: 38%">
                        {{$empresa->nombre}}
                    </td>
                    <td style="text-align: left;width: 12%" class="heading-table "> <strong>RFC:</strong>
                    </td>
                    <td style="text-align: left;">
                        {{$empresa->rfc}}
                    </td>
                </tr>
                <tr>
                    <td style="text-align: left;width: 25%" class="heading-table">
                        <strong> Domicilio: Calle y Número:</strong>
                    </td>
                    <td style="text-align: left;width: 38%">
                        {{$empresadomicilio->lugardomicilio}} # {{$empresadomicilio->numerointerior}}
                    </td>
                    <td style="text-align: left;width: 12%" class="heading-table "> <strong>Colonia:</strong>
                    </td>
                    <td style="text-align: left;">
                        {{$empresacolonia->nombrecolonia}}
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
</div>
<div style="margin-top: -30px">
<div class="card" >
    <div class="card-header" style="margin-top: 0px">

        <h4 class="card-title" style="font-size: 12px;width: 100%;text-align: center"><strong> Datos Bancarios </strong></h4>
    </div>
    <div class="card-body collapse show" style="margin-top:25px; padding-bottom: 2px">
        <div class="table-responsive">
            <table class="table product-overview" cellspacing="0" style="margin-top:25px; border-color: #ffffff;width: 100%; border-top: 0px; font-size: 0.8em;" border="0px">
                <tr>
                    <td  class="heading-table" colspan="2">
                      

                        <a ><strong>Valor de Venta: </strong></a>
                        </td>
                        <td  class="heading-table" colspan="2">
                        <a > ${{ number_format($venta->precio,2).' | '. $precio_venta  }}</a>
                        </td>
                    </tr>
                <tr>
                    <td  class="heading-table" colspan="2">
                      

                        <a ><strong>Descuento: </strong></a>
                        </td>
                        <td  class="heading-table" colspan="2">
                            <a >{{ $tax ? $descuento_porciento .' %': ' Sin descuento' }}</a>
                        </td>
                    </tr>
                <tr>
                    <td  class="heading-table" colspan="2">
                      <a ><strong>Valor de Venta final: </strong></a>
                        </td>
                        <td  class="heading-table" colspan="2">
                            <a > ${{ number_format($saldo_final,2).' | '. ($tax ? $precio_venta_aplicado : $precio_venta)  }}</a>
                        </td>
                    </tr>
                <tr>
                    <td style="text-align: center;" class="heading-table" colspan="4">
                        <strong>{{$empresa->nombre}}</strong>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: right;width: 50%" class="heading-table" colspan="4">
                      <div class="table-responsive" style="border-top: 0px">
                        <table class="table product-overview tablebank"  cellspacing="0" style="margin-top:15px;  border-top: 0px;width: 90%; margin-left: 2%; border-top: 10px; font-size: 0.8em;" border="0px">

                            <tr >
                                <td width="10%" style="border-top: 0px">
                                    <label style="font-size:12px;margin-left: 30px">1</label>
                                </td>
                                <td width="40%" style="border-top: 0px">
                                    <label style="font-size: 12px;text-align: center;margin-left: 60px">Banco</label>
                                </td>
                                <td colspan="2" width="50%" style="border-top: 0px">
                                    <div style="width: 250px;height: 40px;border: 1px solid #000000;text-align: center">
                                        <label style="width:100%;font-size: 12px;margin-top: 10px;float: left;text-align: center">{{$banco->nombrebanco}}</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td width="10%" style="border-top: 0px">
                                    <label style="font-size:12px;margin-left: 30px">2</label>
                                </td>
                                <td width="40%" style="border-top: 0px">
                                    <label style="font-size: 12px;text-align: center;margin-left: 60px">Número de Cuenta</label>
                                </td>
                                <td colspan="2" width="50%" style="border-top: 0px">
                                    <div style="width: 250px;height: 40px;border: 1px solid #000000;text-align: center">
                                        <label style="width:100%;font-size: 12px;margin-top: 10px;float: left;text-align: center">{{$empresacuentas->numerocuenta}}</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td width="10%" style="border-top: 0px">
                                    <label style="font-size:12px;margin-left: 30px">3</label>
                                </td>
                                <td width="40%" style="border-top: 0px">
                                    <label style="font-size: 12px;text-align: center;margin-left: 60px">Sucursal</label>
                                </td>
                                <td colspan="2" width="50%" style="border-top: 0px">
                                    <div style="width: 250px;height: 40px;border: 1px solid #000000;text-align: center">
                                        <label style="width:100%;font-size: 12px;margin-top: 10px;float: left;text-align: center">{{$empresacuentas->sucursal}}</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td width="10%" style="border-top: 0px">
                                    <label style="font-size:12px;margin-left: 30px">4</label>
                                </td>
                                <td width="40%" style="border-top: 0px">
                                    <label style="font-size: 12px;text-align: center;margin-left: 60px">Cuenta Clave</label>
                                </td>
                                <td colspan="2" width="50%" style="border-top: 0px">
                                    <div style="width: 250px;height: 40px;border: 1px solid #000000;text-align: center">
                                        <label style="width:100%;font-size: 12px;margin-top: 10px;float: left;text-align: center">{{$empresacuentas->clave}}</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td width="10%" style="border-top: 0px">
                                    <label style="font-size:12px;margin-left: 30px">5</label>
                                </td>
                                <td width="40%" style="border-top: 0px">
                                    <label style="font-size: 12px;text-align: center;margin-left: 60px">Referencia</label>
                                </td>
                                <td colspan="2" width="50%" style="border-top: 0px">
                                    <div style="width: 250px;height: 40px;border: 1px solid #000000;text-align: center">
                                        <label style="width:100%;font-size: 12px;margin-top: 10px;float: left;text-align: center">{{ $data['tramiteId']}}</label>
                                    </div>
                                </td>
                            </tr>

                        </table>
                    </td>
                </tr>

            </table>
        </div>
    </div>
</div>


<div style="margin-top: -45px">
<div class="card" style="border: 0px;">

 <div class="card-body collapse show" style="padding-bottom: 2px;border: 0px">
  <div class="table-responsive" style="border: 0px">
    <table class="table product-overview" cellspacing="0" style="margin-top:0px; width: 100%; margin-left: 2%; font-size: 0.8em;border: 0px" border="0px">

        <tr>
            <td colspan="4" style="border-top: 0px">
                <div style="width: 322px;height: 30px;background-color: #BFBFBF;text-align: center;margin-left: 30%;margin-top: 0px">
                    <label style="width:100%;font-size: 12px;padding-top: 5px;float: left;text-align: center;font-weight: bold;">Anexar comprobante de pago</label>
                </div>
                <div style="width: 320px;height: 100px;border: 0px solid #000000;text-align: center;margin-left: 30%">

                    <div style="position: relative; width: 300px;margin-top: 2px;">
                        <img align="center" src="{!! isset($firma) ?  $firma  : '' !!}" width="100px" />
                    </div>
                           <span style="width:250px;text-decoration: underline;font-size: 12px">
                          
            {{isset($gerente) ? $gerente['firstName'] .' '.$gerente['lastName'] : ''}}
            </span><br>
                    <label style="width:300px;font-size: 12px;position:relative;padding-top: 75px;text-align: center;font-weight: bold">Gerente de Ventas</label>
                </div>
            </td>
        </tr>

    </table>
   </div>
 </div>
</div>
</div>
</div>




</div>
@stop

