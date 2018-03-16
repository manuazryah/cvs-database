<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UploadFile
 *
 * @author user
 */

namespace common\components;

use Yii;
use yii\base\Component;
use yii\helpers\FileHelper;
use yii\imagine\Image;
use Imagine\Image\Box;

class UploadFile extends Component {

	public function UploadFiles($model, $main_image, $path, $sizes) {

		if (file_exists($path)) {


			if (file_exists($path . '/' . $model->id)) {
				$file = $path . '/' . $model->id . '/' . $model->id . '.' . $main_image->extension;
				if (file_exists($file)) {
					unlink($file);
				}
				if ($main_image->saveAs($path . '/' . $model->id . '/' . $model->id . '.' . $main_image->extension)) {
					$filepath = $path . '/' . $model->id . '/';
					$this->ImageResize($sizes, $filepath, $model, $main_image);
				}
			} else {
				FileHelper::createDirectory($path . '/' . $model->id, $mode = 0775, $recursive = true);
				$file = $path . '/' . $model->id . '/' . $model->id . '.' . $main_image->extension;
				if (file_exists($file)) {
					unlink($file);
				}
				if ($main_image->saveAs($path . '/' . $model->id . '/' . $model->id . '.' . $main_image->extension)) {
					$filepath = $path . '/' . $model->id . '/';
					$this->ImageResize($sizes, $filepath, $model, $main_image);
				} else {
					return false;
				}
			}
		} else {


			FileHelper::createDirectory($path, $mode = 0775, $recursive = true);

			if ($main_image->saveAs($path . '/' . $model->id . '.' . $main_image->extension)) {
				$newpath = $path . '/';
				$this->ImageResize($sizes, $newpath, $model, $main_image);
			}
		}
	}

	public function UploadFile($model, $main_image, $path, $sizes) {
		if (file_exists($path)) {

			$file = $path . '/' . $model->id . '.' . $main_image->extension;
			if (file_exists($path)) {
				$this->recursiveRemoveDirectory($path);
			}
			if ($main_image->saveAs($path . '/' . $model->id . '.' . $main_image->extension)) {
				//$newpath = $path . '/';
				$this->ImageResize($sizes, $path, $model, $main_image);
			} else {
				return FALSE;
			}
		} else {
			FileHelper::createDirectory($path, $mode = 0775, $recursive = true);

			if ($main_image->saveAs($path . '/' . $model->id . '.' . $main_image->extension)) {
				//$newpath = $path . '/';
				$this->ImageResize($sizes, $path, $model, $main_image);
			}
		}
	}

	public function ImageResize($sizes, $path, $model, $image) {

		foreach ($sizes as $size) {
			$savePath = $path . '/' . $size[name] . '.' . $image->extension;

			$fileName = $path . '/' . $model->id . '.' . $image->extension;

			$resized_image = $path . '/' . $size[name] . '.' . $image->extension;
			if (file_exists($resized_image))
				unlink($resized_image);
			Image::getImagine()->open($fileName)->thumbnail(new Box($size[width], $size[height]))->save($savePath, ['quality' => 90]);
			//unlink($fileName);
		}
	}

	function recursiveRemoveDirectory($directory) {
		foreach (glob("{$directory}/*") as $file) {
			if (is_dir($file)) {
				return true;
				//recursiveRemoveDirectory($file);
			} else {
				unlink($file);
			}
		}
	}

	public function UploadSingle($files, $model, $paths) {

                if ($files != '' && $model != '') {
                        $path = $this->CheckPath($paths);
                        foreach ($files as $file) {
                                $name = $this->fileExists($path, $file->baseName . '.' . $file->extension, $file, 1);
                                $file->saveAs($path . '/' . $name);
                        }
                        return true;
                } else {

                        return false;
                }
        }

	public function CheckPath1($paths) {
		if (!is_dir($paths))
			mkdir($paths);
		return $paths;
	}

	public function fileExists($path, $name, $file, $sufix) {
		if (file_exists($path . '/' . $name)) {

			$name = basename($path . '/' . $file->baseName, '.' . $file->extension) . '_' . $sufix . '.' . $file->extension;
			return $this->fileExists($path, $name, $file, $sufix + 1);
		} else {
			return $name;
		}
	}

	public function ListFile($id, $type) {

		$attach = '';
		$folder = $this->folderName(0, 10000, $id);
		$path = Yii::getAlias(Yii::$app->params['uploadPath']) . '/' . Yii::$app->params['mainPath'] . '/' . Yii::$app->params['appointmentPath'] . '/' . $folder . '/' . $id . '/' . $type;

		foreach (glob("{$path}/*") as $file) {
			if ($file != '') {
				$arry = explode('/', $file);
				$path = Yii::$app->params['mainPath'] . '/' . Yii::$app->params['appointmentPath'] . '/' . $folder . '/' . $id . '/' . $type . '/' . end($arry);
				$attach .= '<a target="_blank" href="' . Yii::$app->homeUrl . '/' . Yii::$app->params['mainPath'] . '/' . Yii::$app->params['appointmentPath'] . '/' . $folder . '/' . $id . '/' . $type . '/' . end($arry) . '">' . end($arry) . '</a>&nbsp;&nbsp;<a href="' . Yii::$app->homeUrl . Yii::$app->params['appointmentPath'] . '/' . $type . '/' . 'remove?path=' . $path . '"><i class="fa fa-remove"></i></a>&nbsp;&nbsp;|&nbsp;&nbsp;';
			}
		}
		// echo $attach;exit;
		return $attach;
	}

	public function CheckPath($paths) {

                $root = Yii::getAlias(Yii::$app->params['uploadPath']).'/uploads'; /* Yii::$app->basePath; */
                foreach ($paths as $path) {
                        $root .= '/' . $path;

                        if (!is_dir($root))
                                mkdir($root);
                }
                return $root;
        }

	public function RemoveFiles($paths) {
		$files = glob($paths . '/*');
		foreach ($files as $file) {
			if (is_file($file))
				unlink($file); //delete file
		}
		rmdir($paths);
	}

	public function folderName($min, $max, $id) {
		if ($id > $min && $id < $max) {
			return $max;
		} else {
			$xy = $this->folderName($min + 10000, $max + 10000, $id);
			return $xy;
		}
	}

}
