<?php

    class crawl_content {

        public $folder_path;

        function __construct($folder_path) {

            $this->create_folder_book($folder_path);

        }

        function get_chapter_code($code) {

            if (is_string($code)) {

                $code = explode('/', $code);
                $code = $code[count($code) - 1];
                return $code;

            }

        }

        function get_format_api($chapter_id) {

            $api = 'https://novel.snssdk.com/api/novel/book/reader/full/v1/?item_id='.$chapter_id.'&fbclid=IwAR3s0ajpty3Avb4kgncaW3Bn5RYGw7fQuP-Hvy5UguN5rLrEbHe2NKql9v4';
            return $api;

        }
        
        function get_data_chapter($api_url) {
            
            $json_data = file_get_contents($api_url);
            $response_data = json_decode($json_data);
            $data = $response_data->data;
            return $data;
          
        }
          
        function create_folder_book($path) {
            
            if ( !is_dir( $path ) ) {

                mkdir($path, 0777);
                return true;
            
            }

            return false;
            
        }

        function create_file_chapter($path, $content) {

            $fp = fopen($path, "wb");
            fwrite($fp,$content);
            fclose($fp);

        }

    }

?>