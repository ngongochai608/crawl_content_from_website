<?php
  require_once 'simplehtmldom/simple_html_dom.php';
  require_once 'crawl_content.php';
  require_once 'html2text/html2text.php';

  function run_get_book ($url_book) {
    // // Path
    $path_download = getcwd().'/downloads';
  
    // // Get html website
    $craw_content = new crawl_content($path_download);
  
    $html = file_get_html($url_book);
  
    $chapter_codes = $html->find('.chapter-item-title');
  
    array_shift($chapter_codes);
  
    foreach($chapter_codes as $chapter_code) {
  
        $chapter_id = $craw_content->get_chapter_code($chapter_code->href);
        $api = $craw_content->get_format_api($chapter_id);
        $data = $craw_content->get_data_chapter($api);
  
        $book_name = $data->novel_data->book_name;
        $title_chapter = $data->novel_data->chapter_title;
        $chapter_content = convert_html_to_text($data->content, true);
        $path_book = $path_download.'/'.$book_name;
  
        $craw_content->create_folder_book($path_book);
  
        if (is_dir($path_book)) {
  
          $path_chapter = $path_book.'/'.$title_chapter;

          if ( !file_exists($path_chapter) ) {

            $craw_content->create_file_chapter($path_chapter, $chapter_content);

          } else {

            continue;

          }
  
        }
  
    }
  }

?>