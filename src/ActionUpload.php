<?php 
namespace Lianjiexue\Ueditor;


class ActionUpload
{
	public function handle($action,$baseConfig)
	{
		$base64 = "upload";

		switch (htmlspecialchars($action)) {
		    case 'uploadimage':
		        $config = array(
		            "pathFormat" => $baseConfig['imagePathFormat'],
		            "maxSize" => $baseConfig['imageMaxSize'],
		            "allowFiles" => $baseConfig['imageAllowFiles']
		        );
		        $fieldName = $baseConfig['imageFieldName'];
		        break;
		    case 'uploadscrawl':
		        $config = array(
		            "pathFormat" => $baseConfig['scrawlPathFormat'],
		            "maxSize" => $baseConfig['scrawlMaxSize'],
		            "allowFiles" => $baseConfig['scrawlAllowFiles'],
		            "oriName" => "scrawl.png"
		        );
		        $fieldName = $baseConfig['scrawlFieldName'];
		        $base64 = "base64";
		        break;
		    case 'uploadvideo':
		        $config = array(
		            "pathFormat" => $baseConfig['videoPathFormat'],
		            "maxSize" => $baseConfig['videoMaxSize'],
		            "allowFiles" => $baseConfig['videoAllowFiles']
		        );
		        $fieldName = $baseConfig['videoFieldName'];
		        break;
		    case 'uploadfile':
		    default:
		        $config = array(
		            "pathFormat" => $baseConfig['filePathFormat'],
		            "maxSize" => $baseConfig['fileMaxSize'],
		            "allowFiles" => $baseConfig['fileAllowFiles']
		        );
		        $fieldName = $baseConfig['fileFieldName'];
		        break;
		}

		/* 生成上传实例对象并完成上传 */
		$up = new Uploader($fieldName, $config, $base64);

		/**
		 * 得到上传文件所对应的各个参数,数组结构
		 * array(
		 *     "state" => "",          //上传状态，上传成功时必须返回"SUCCESS"
		 *     "url" => "",            //返回的地址
		 *     "title" => "",          //新文件名
		 *     "original" => "",       //原始文件名
		 *     "type" => ""            //文件类型
		 *     "size" => "",           //文件大小
		 * )
		 */

		/* 返回数据 */
		return json_encode($up->getFileInfo());
	}
}