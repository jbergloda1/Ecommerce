<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\product\ProductCollection;
use App\Repositories\ProductRepository;
use App\Http\Resources\product\ProductResource;
use App\Http\Resources\BaseResource;
use App\Http\Resources\BaseCollection;
use App\Http\Resources\product\ProductImageCollection;
use App\Http\Resources\product\ProductSizeResource;
use App\Http\Resources\product\ProductImageResource;
use App\Http\Resources\product\ProductColorResource;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductImageRequest;
use App\Http\Requests\ProductSizeRequest;
use App\Http\Requests\ProductColorRequest;

class ProductController extends Controller
{
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function search(ProductRequest $request)
    {
        return new ProductCollection($this->productRepository->search($request->searchFilter()));
    }

    public function store(ProductRequest $request, ProductImageRequest $requestImage, ProductSizeRequest $requestSize, ProductColorRequest $requestColor)
    {
        if($request->hasFile('img')){
            $image          = $request->file('img');
            $newNamefile    = rand().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('/uploads'),$newNamefile);
            $import_price   = $request->import_price;
            $sale           = $request->sale;
            $export_price   = $import_price*((100-$sale)/100);//Số-tiền-sau-khi-giảm-giá = Giá-tiền x [(100 –  %-giảm-giá)/100]
            $product        = new ProductResource($this->productRepository->store($request->storeFilter(), $newNamefile, $export_price));
            $product_id     = $product->id;

            //Product Images
            if(isset($requestImage->image)){
                $images         = $requestImage->file('image');
                $imageName      = '';
                foreach($images as $imagee){
                $new_name       = rand().'.'.$imagee->getClientOriginalExtension();
                $imagee->move(public_path('/uploads/Detail'),$new_name);
                $imageName      = $imageName.$new_name.',';
                new ProductImageResource($this->productRepository->storeImage($new_name, $product_id));
                }
            }
            //Product Size
            if(isset($requestSize->size)){
                $size = $requestSize->size;
                $amount = $requestSize->amount;
                foreach($size as $rowSize){
                    $data = array('size'=>$rowSize, 'amount'=>$amount);
                    new ProductSizeResource($this->productRepository->storeSize($data, $product_id));
                }
                $amountTotal = ($this->productRepository->showAmount($product_id));
                new ProductResource($this->productRepository->storeAmount($product_id, $amountTotal));

            }
            //Product Color
            if(isset($requestColor->color)){
                $color = $requestColor->color;
                foreach($color as $rowColor){
                    new ProductColorResource($this->productRepository->storeColor($rowColor, $product_id));
                }
            }
            return $product;
        }
    }

    public function show($id)
    {
        return new ProductResource($this->productRepository->show($id));
    }

    public function destroy($id)
    {
        $getdata = new ProductResource($this->productRepository->show($id));
        $img = $getdata->img;
        unlink("uploads/".$img); 
        $imgDetail = $this->productRepository->showImage($id);
        for($x = 0; $x < count($imgDetail); $x++) {
            $data = array($imgDetail[$x]);
            $anh = $data[0]['image'];
            unlink("uploads/Detail/".$anh);
        }      
        return new BaseResource($this->productRepository->destroy($id));
    }

    public function update(ProductRequest $request, $id)
    {
        //get data product
        $getdataProductId = new ProductResource($this->productRepository->show($id));
        $imgId = $getdataProductId->img;
        //Product
        if(!empty($request->img)){
            $image          = $request->file('img');
            $newNamefile    = rand().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('/uploads'),$newNamefile);
            unlink("uploads".$imgId);
            $import_price   = $request->import_price;
            $sale           = $request->sale;
            $export_price   = $import_price*((100-$sale)/100);
            return new ProductResource($this->productRepository->update($request->updateFilter(), $id, $export_price, $newNamefile));
        }
    }
}
 
