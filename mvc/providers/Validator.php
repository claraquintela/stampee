<?php

namespace App\Providers;

class Validator
{
    private $errors = array();
    private $key;
    private $value;
    private $name;

    public function field($key, $value, $name = null)
    {
        $this->key = $key;
        $this->value = $value;
        if ($name == null) {
            $this->name = ucfirst($key);
        } else {
            $this->name = ucfirst($name);
        }
        return $this;
    }
    ////////////// VALIDATION RULES  ////////////////////////////
    public function required()
    {
        if (empty($this->value)) {
            $this->errors[$this->key] = "$this->name is required.";
        }
        return $this;
    }

    public function max($length)
    {
        if (strlen($this->value) > $length) {
            $this->errors[$this->key] = "$this->name must be less than $length characters";
        }
        return $this;
    }

    public function min($length)
    {
        if (strlen($this->value) < $length) {
            $this->errors[$this->key] = "$this->name must be bigger than $length characters";
        }
        return $this;
    }

    public function email()
    {
        if (!empty($this->value) && !filter_var($this->value, FILTER_VALIDATE_EMAIL)) {
            $this->errors[$this->key] = "Invalid $this->name format";
        }
        return $this;
    }

    public function unique($model)
    {
        $model = 'App\\Models\\' . $model;
        $model = new $model;
        $unique = $model->unique($this->key, $this->value);
        if ($unique) {
            $this->errors[$this->key] = "This $this->name must be unique";
        }
        return $this;
    }

    public function password()
    {
        if (!empty($this->value)) {
            if (strlen($this->value) < 5 || strlen($this->value) > 20) {
                $this->errors[$this->key] = "$this->name doit contenir entre 5 et 20 caractères.";
            } elseif (!preg_match('/[a-z]/', $this->value)) {
                $this->errors[$this->key] = "$this->name doit contenir au moins une lettre minuscule.";
            } elseif (!preg_match('/[A-Z]/', $this->value)) {
                $this->errors[$this->key] = "$this->name doit contenir au moins une lettre majuscule.";
            }
        }
        return $this;
    }

    public function isSuccess()
    {
        if (empty($this->errors)) return true;
    }

    public function getErrors()
    {
        if (!$this->isSuccess()) return $this->errors;
    }


    public function uploadImage($postFiles)
    {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($this->value);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($postFiles["image"]["tmp_name"]);
        if ($check !== false) {
            error_log("File is an image - " . $check["mime"] . ".");
            $uploadOk = 1;
        } else {
            error_log('File is not an image.');
            $this->errors[$this->key] = 'File is not an image.';
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            error_log('Sorry, file already exists.');
            $this->errors[$this->key] = 'Sorry, file already exists.';
            $uploadOk = 0;
        }

        // Check file size
        if ($postFiles["image"]["size"] > 500000000) {
            error_log('Sorry, your file is too large.');
            $this->errors[$this->key] = "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            error_log('Sorry, only JPG, JPEG, PNG & GIF files are allowed.');
            $this->errors[$this->key] = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.';
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            error_log('Sorry, your file was not uploaded.');
            $this->errors[$this->key] = 'Sorry, your file was not uploaded.';
            return false;
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($postFiles["image"]["tmp_name"], $target_file)) {
                error_log("The file " . htmlspecialchars(basename($this->value)) . " has been uploaded.");
                return true;
            } else {
                error_log("Sorry, there was an error uploading your file.");
                $this->errors[$this->key] = "Sorry, there was an error uploading your file.";
                return false;
            }
        }
    }
}
