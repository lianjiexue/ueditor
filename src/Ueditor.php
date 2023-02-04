<?php 
namespace Lianjiexue\Ueditor;

class Ueditor
{
	//上传配置
	public $config;
	//图片的数量
	public $size;
	//图片开始读取的位置
	public $start;
	//初始化
	public function __construct($options)
	{
		$this->config = json_decode(preg_replace("/\/\*[\s\S]+?\*\//", "", Config::info()), true);
		foreach($options as $key=>$option) {
			$this->config[$key] = $option;
		}
	}

	public function dispatch($action,$callback=null)
	{
		switch ($action) {
		    case 'config':
		        $result =  json_encode($this->config);
		        break;

		    /* 上传图片 */
		    case 'uploadimage':
		    /* 上传涂鸦 */
		    case 'uploadscrawl':
		    /* 上传视频 */
		    case 'uploadvideo':
		    /* 上传文件 */
		    case 'uploadfile':
		    	$result = (new ActionUpload())->handle($action,$this->config);
		        break;

		    /* 列出图片 */
		    case 'listimage':
		        $result = (new ActionList())->handle($action,$this->config,$size,$start);
		        break;
		    /* 列出文件 */
		    case 'listfile':
		        $result = (new ActionList())->handle($action,$this->config,$size,$start);
		        break;

		    /* 抓取远程文件 */
		    case 'catchimage':
		        $result = (new ActionList())->handle($action,$this->config);
		        break;

		    default:
		        $result = json_encode(array(
		            'state'=> '请求地址出错'
		        ));
		        break;
		}
		/* 输出结果 */
		if (isset($callback)) {
		    if (preg_match("/^[\w_]+$/", $callback)) {
		        return htmlspecialchars($callback) . '(' . $result . ')';
		    } else {
		        return json_encode(array(
		            'state'=> 'callback参数不合法'
		        ));
		    }
		} else {
		    return $result;
		}
	}
}
