<?php

namespace App\Http\Controllers;

use App\Http\Requests\saveSliderRequest;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function sliders()
    {
        $sliders = Slider::all();
        return view('admin.slider.sliders', compact('sliders'));
    }
    
    public function add()
    {
        return view('admin.slider.add_slider');
    }

    public function save(saveSliderRequest $request)
    {
        $slider = new Slider();
        $slider->description_one = request('description_one');
        $slider->description_two = request('description_two');
        $slider->status = 1;

        $image = request('image');
        $imageName = uniqid()."_".$image->getClientOriginalName();
        $image->move(public_path("storage/slider_images/"), $imageName);
        $slider->image = $imageName;

        $slider->save();

        return back()->with('success', 'The '.$slider->name.' has been created successfully!');
    }

    public function edit($id)
    {
        $slider = Slider::findOrFail($id);
        return view('admin.slider.edit_slider', compact('slider'));
    }

    public function update(saveSliderRequest $request, $id)
    {
        $slider = Slider::findOrFail($id);
        $slider->description_one = request('description_one');
        $slider->description_two = request('description_two');
        $slider->status = 1;

        if(request('image')) {
            $image = request('image');
            $imageName = uniqid()."_".$image->getClientOriginalName();
            $image->move(public_path("storage/slider_images/"), $imageName);
            $slider->image = $imageName;
        }

        $slider->update();

        return back()->with('success', 'The '.$slider->name.' has been updated successfully!');
    }

    public function delete($id)
    {
        $slider = Slider::findOrfail($id);

        if($slider->image != 'noimage.jpg')
        {
            Storage::delete('public/slider_images/'.$slider->image);
        }

        $slider->delete();

        return back()->with('success', 'The '.$slider->name.' has been deleted successfully!');
    }

    public function activate($id)
    {
        $slider = Slider::findOrFail($id);
        $slider->status = 1;
        $slider->update();

        return back()->with('success', 'The '.$slider->name.' has been activated successfully!');
    }

    public function deactivate($id)
    {
        $slider = Slider::findOrFail($id);
        $slider->status = 0;
        $slider->update();

        return back()->with('success', 'The '.$slider->name.' has been deactivated successfully!');
    }
}
