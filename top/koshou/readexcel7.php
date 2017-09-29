<?php
//PHPExcel ライブラリの読み込み
include_once( dirname( __FILE__ ) . '/Classes/PHPExcel.php' );
include_once( dirname( __FILE__ ) . '/Classes/PHPExcel/IOFactory.php' );

//セルの指定
$Row = rand(12,14);//列 A→0，B→1・・・
$Cell = rand(2,30);//行

//endsWith 関数の定義
function endsWith( $str, $suffix ){
  $len = strlen( $suffix );
  return $len == 0 || substr( $str, strlen( $str ) - $len, $len ) === $suffix;
}

//. 対象ファイル名
$excelfilename = '170627.xlsx';
$excelfilepath = dirname( __FILE__ ) . '/' . $excelfilename;

//. ファイル拡張子によってリーダーインスタンスを変える
$reader = null;
if( endsWith( $excelfilename, 'xls' ) ){
  $reader = PHPExcel_IOFactory::createReader( 'Excel5' );
}else if( endsWith( $excelfilename, 'xlsx' ) ){
  $reader = PHPExcel_IOFactory::createReader( 'Excel2007' );
}
$file = $reader->load( $excelfilepath );
  // セルの値を表示
  $file->setActiveSheetIndex(0);
  $sheet = $file->getActiveSheet();
  $Mora = $sheet->getCellByColumnAndRow( $Row, $Cell )->getValue();
  echo $sheet->getCellByColumnAndRow( $Row, $Cell )->getValue();
  echo '<input type="hidden" id = "mora" value="'. $Mora .'">';
?>