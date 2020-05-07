<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VentasVendedor;
use App\ComisionVentasVendedor;
//use App\Vendedor;

class VentasVendedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendedor = VentasVendedor::orderBy('id','DESC')->get();
        
        return response()->json([
            'success' => true, 'data' => $vendedor
        ], 200);
    }

    /**
     * metaPropia .
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function metaPropia(Request $request)
    {
        //var_dump($request);die;
        $id_vendedor = $request->id_vendedor;
        $fecha_ini=$request->fecha_ini;
        $fecha_fin=$request->fecha_fin;

        //var_dump($id_vendedor,$fecha_ini,$fecha_fin);die;
        $meta = \DB::select('select sum(monto) as monto from ventas_vendedors where id_vendedor = :id_vendedor and date BETWEEN :fecha_ini and :fecha_fin',array(
            'id_vendedor'=>$id_vendedor,
            'fecha_ini'=>"$fecha_ini",
            'fecha_fin'=>"$fecha_fin"
        ));
        //var_dump($meta[0]->monto);die;
        switch ($meta[0]->monto) {
            case 25000:
                $bono = \DB::select('select sum(monto) as monto from comision_ventas_vendedors where id_vendedor = :id_vendedor and date BETWEEN :fecha_ini and :fecha_fin',array(
                    'id_vendedor'=>$id_vendedor,
                    'fecha_ini'=>"$fecha_ini",
                    'fecha_fin'=>"$fecha_fin"
                ));
                return response()->json([
                    'success' => true,
                    'data'=>$bono[0]->monto + 400
                ], 200);
                break;
            case 15000:
                $bono = \DB::select('select sum(monto) as monto from comision_ventas_vendedors where id_vendedor = :id_vendedor and date BETWEEN :fecha_ini and :fecha_fin',array(
                    'id_vendedor'=>$id_vendedor,
                    'fecha_ini'=>"$fecha_ini",
                    'fecha_fin'=>"$fecha_fin"
                ));
                return response()->json([
                    'success' => true,
                    'data'=>$bono[0]->monto + 300
                ], 200);
                break;
            case 10000:
                $bono = \DB::select('select sum(monto) as monto from comision_ventas_vendedors where id_vendedor = :id_vendedor and date BETWEEN :fecha_ini and :fecha_fin',array(
                    'id_vendedor'=>$id_vendedor,
                    'fecha_ini'=>"$fecha_ini",
                    'fecha_fin'=>"$fecha_fin"
                ));
                return response()->json([
                    'success' => true,
                    'data'=>$bono[0]->monto + 200
                ], 200);
                break;
            case 5000:
                $bono = \DB::select('select sum(monto) as monto from comision_ventas_vendedors where id_vendedor = :id_vendedor and date BETWEEN :fecha_ini and :fecha_fin',array(
                    'id_vendedor'=>$id_vendedor,
                    'fecha_ini'=>"$fecha_ini",
                    'fecha_fin'=>"$fecha_fin"
                ));
                return response()->json([
                    'success' => true,
                    'data'=>$bono[0]->monto + 150
                ], 200);
                break;
            default:
            return response()->json([
                'success' => true,
                'data'=>'no cumple con bono'
            ], 200);
                break;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id_vendedor = $request->id_vendedor;
        $monto = $request->monto;
        $date = date('Y-m-d H:i:s');

        $venta = VentasVendedor::create([
            'id_vendedor' => $id_vendedor,
            'monto' => $monto,
            'date'=>$date
        ]);
        $venta->save();

        $comision1 = ComisionVentasVendedor::create([
            'id_vendedor' => $id_vendedor,
            'id_veta'=>$venta->id,
            'monto' => floatval($monto * 0.3),
            'date'=>$date
        ]);
        $comision1->save();

        $v = \DB::table('vendedors')
            ->select('cod_parent')
            ->where('id', '=', $id_vendedor)
            ->get();

        $parent  = $v[0]->cod_parent;
        $c = \DB::table('vendedors')
                ->where('id', '=', $parent)
                ->get();

        for ($i=0; $i < 4; $i++) { 
            if($i == 0){
                $comision = 0.12;
            }
            if($i == 1){
                $comision = 0.012;
            }
            if($i == 2){
                $comision = 0.08;
            }
            if($i == 3){
                $comision = 0.06;
            }
            
            $nc = \DB::table('vendedors')
                ->where('id', '=', $parent)
                ->get();

            if(count($nc)>0){
                $vendedor = $nc[0]->id;

                $comision = ComisionVentasVendedor::create([
                    'id_vendedor' => $vendedor,
                    'id_veta'=>$venta->id,
                    'monto' => floatval($monto * $comision),
                    'date'=>$date
                ]);
                $comision->save();

            $parent = $nc[0]->cod_parent;
            }
            

        }    
        

        
        return response()->json([
            'success' => true
        ], 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
