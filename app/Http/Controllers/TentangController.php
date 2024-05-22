<?PHP
namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class TentangController extends Controller
{
    public function index()
    {
        $about = About::first();
        return view('tentang.index', compact('about'));
    }

    public function update(Request $request, About $about)
    {
        $input = $request->all();
        
        if ($request->hasFile('logo')) {
            // Hapus gambar lama jika ada
            File::delete('uploads/' . $about->logo);
            
            // Simpan gambar baru
            $logo= $request->file('logo');
            $nama_logo = time() . rand(1, 9) . '.' . $logo->getClientOriginalExtension();
            $logo->storeAs('uploads', $nama_logo);
            
            // Simpan nama gambar baru ke dalam input
            $input['logo'] = $nama_logo;
        } else {
            unset($input['logo']);
        }

        // Update data About
        $about->update($input);
        return redirect('/tentang');
    }

}
