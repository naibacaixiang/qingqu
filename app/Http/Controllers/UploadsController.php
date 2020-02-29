<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Handlers\ImageUploadHandler;

class UploadsController extends Controller
{
    public function uploadImg(Request $request)
    {
        $file = $request->file("mypic");
        // dd($file);
        if (!empty($file)) {
            foreach ($file as $key => $value) {
                $len = $key;
            }
            if ($len > 25) {
                return response()->json(['ResultData' => 6, 'info' => '最多可以上传25张图片']);
            }
            $m = 0;
            $k = 0;
            for ($i = 0; $i <= $len; $i++) {
                // $n 表示第几张图片
                $n = $i + 1;
                if ($file[$i]->isValid()) {
                    if (in_array(strtolower($file[$i]->extension()), ['jpeg', 'jpg', 'gif', 'gpeg', 'png'])) {
                        $picname = $file[$i]->getClientOriginalName();//获取上传原文件名
                        $ext = $file[$i]->getClientOriginalExtension();//获取上传文件的后缀名
                        // 重命名
                        $filename = time()  . "." . $ext;
                        $aaDir = date('Ymd');
                        $newDir = 'uploads/images/'. $aaDir;
                        if ($file[$i]->move($newDir, $filename)) {
                            $newFileName = '/' . $newDir . '/' . $filename;
                            $m = $m + 1;
                            // return response()->json(['ResultData' => 0, 'info' => '上传成功', 'newFileName' => $newFileName ]);
                        } else {
                            $k = $k + 1;
                            // return response()->json(['ResultData' => 4, 'info' => '上传失败']);
                        }
                        $msg = $m . "张图片上传成功 " . $k . "张图片上传失败<br>";
                        $return[] = ['ResultData' => 0, 'info' => $msg, 'newFileName' => $newFileName];
                    } else {
                        return response()->json(['ResultData' => 3, 'info' => '第' . $n . '张图片后缀名不合法!<br/>' . '只支持jpeg/jpg/png/gif格式']);
                    }
                } else {
                    return response()->json(['ResultData' => 1, 'info' => '第' . $n . '张图片超过最大限制!<br/>' . '图片最大支持2M']);
                }
            }
        } else {
            return response()->json(['ResultData' => 5, 'info' => '请选择文件']);
        }
        return $return;
    }







    public function uploadImage(Request $request, ImageUploadHandler $uploader)
    {
        // 初始化返回数据，默认是失败的
        $data = [
            'success'   => false,
            'msg'       => '上传失败!',
            'file_path' => ''
        ];
        // 判断是否有上传文件，并赋值给 $file
        if ($file = $request->upload_file) {
            // 保存图片到本地
            $result = $uploader->save($file, 'posts', 'ooxx', 1024);
            // 图片保存成功的话
            if ($result) {
                $data['file_path'] = $result['path'];
                $data['msg']       = "上传成功!";
                $data['success']   = true;
            }
        }
        return $data;
    }
}