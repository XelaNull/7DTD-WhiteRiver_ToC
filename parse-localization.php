#!/usr/local/bin/php
<?php
include ".translationconfig.inc.php";

/*
parse-localization.php -- Written by Shouden Kalferas
For use with 7 Days to Die Localization.txt
Premise:
  Different modlet authors appear to use different syntax/format than what
  is currently being used by the vanilla game in A19. This modlet will read in
  various modlet Localization.txt and output a standardized format. It also will
  convert all usages of " within a replace with '. It surrounds all language
  values with double quotes and ensures that there are no extra quotes.
Instructions:
  Before you use, make SURE that the path to your php executable is correct on
  the top line of this script. Different operating systems have different paths
  to this. Next, make SURE you give this script an executable bit like:
    chmod a+x parse-localization.php
Example Syntax: ./parse-localization.php <full path to Localization.txt that you wish to convert>
The output will NOT include the required header at the top of the Localization.txt
At the time of this writing, the current first line of a Localization.txt file is:
Key,File,Type,UsedInMainMenu,NoTranslate,english,Context / Alternate Text,german,latam,french,italian,japanese,koreana,polish,brazilian,russian,turkish,schinese,tchinese,spanish
*/
// Read in the file to convert and store as an array we can loop over.
$incomingFile=file($argv[1]);
$cnt=0;
// Loop over each line in the file to convert.
foreach($incomingFile as $line)
  {
    // If the length of the line is less than three characters, assume it is a blank line.
    // three characters to make sure we rule out lines with \n and \r together
    if(strlen($line)<3) continue;
    // Start a line counter
    $cnt++;
    // Remove the \n and \r (line feed & carriage return) characters from the line
    $line=str_replace("\n","",$line);
    $line=str_replace("\r","",$line);
    // Test the line to see if the line is a file header
    // We perform this test by first converting the entire line to lowercase..
    // Then we look to see if the string ",english" is present. This string is
    // universal to all formats of the Localization.txt that I've encountered.
    $lowerLine=strtolower($line);
    if(strpos($lowerLine,",english")!==FALSE)
      { // This *IS* a Header Line
        // Create an array of all the field names in the header line.
        $HeaderArray=explode(",",$lowerLine);
        $HeaderCnt=0;
        // Loop over all the fields in the header
        foreach($HeaderArray as $HeaderItem)
          {
            // Create an array called Header and store into it the values of each
            // of the fields, along with the header position.
            $HeaderCnt++;
            $Header[$HeaderCnt]=$HeaderItem;
            //echo "Header[$HeaderCnt]: [$HeaderItem]\n";
          }
        // Once we are done looping over all the fields in the header line, we
        // should move on to the next line in the file.
        continue;
      }

    // Variations of the Localization.txt that I've encountered:
    // FROM:
    // Key,Source,Context,Changes,English,French,German,Klingon,Spanish,Polish
    // Key,Source,Context,UsedInMainMenu,NoTranslate,english
    // Key,Source,Context,English,German

    // What we want to convert the above into:
    // TO:
    //Key,File,Type,UsedInMainMenu,NoTranslate,english,Context / Alternate Text,german,latam,french,italian,japanese,koreana,polish,brazilian,russian,turkish,schinese,tchinese,spanish

    // Create an array called lineArray that is comprised of all the values from
    // the comma-delimitted file.
    $lineArray=str_getcsv($line,",","\"");
    $LineCnt=0;
    // Ensure that for each line, we set all our variables to NULL so we don't
    // carry over any value from the previous line.
    $Key=''; $File=''; $Type=''; $UsedInMainMenu=''; $NoTranslate='';
    $English=''; $AltText=''; $German=''; $Latam=''; $French=''; $Italian='';
    $Japanese=''; $Koreana=''; $Polish=''; $Brazilian=''; $Russian=''; $Turkish='';
    $SChinese=''; $TChinese=''; $Spanish='';
    // Loop over all values in the line
    foreach($lineArray as $lineItem)
      {
        // The section below stores each value into a variable representing the
        // final value/variable we will want to output.
        $LineCnt++;
        //if($LineCnt=='21') { echo "****************************"; echo $argv[1]; }
        switch(@$Header[$LineCnt])
          {
            case "key": $Key=$lineItem; break;
            case "file":
            case "source": $File=$lineItem; break;
            case "type":
            case "context": $Type=$lineItem; break;
            case "usedinmainmenu": $UsedInMainMenu=$lineItem; break;
            case "notranslate": $NoTranslate=$lineItem; break;
            case "english": $English=addQuotes($lineItem); break;
            case "context / alternate text": $AltText=$lineItem; break;
            case "german": $German=translate($Header[$LineCnt],$English,addQuotes($lineItem)); break;
            case "latam": $Latam=translate($Header[$LineCnt],$English,addQuotes($lineItem)); break;
            case "french": $French=translate($Header[$LineCnt],$English,addQuotes($lineItem)); break;
            case "italian": $Italian=translate($Header[$LineCnt],$English,addQuotes($lineItem)); break;
            case "japanese": $Japanese=translate($Header[$LineCnt],$English,addQuotes($lineItem)); break;
            case "koreana": $Koreana=translate($Header[$LineCnt],$English,addQuotes($lineItem)); break;
            case "polish": $Polish=translate($Header[$LineCnt],$English,addQuotes($lineItem)); break;
            case "brazilian": $Brazilian=translate($Header[$LineCnt],$English,addQuotes($lineItem)); break;
            case "russian": $Russian=translate($Header[$LineCnt],$English,addQuotes($lineItem)); break;
            case "turkish": $Turkish=translate($Header[$LineCnt],$English,addQuotes($lineItem)); break;
            case "schinese": $SChinese=translate($Header[$LineCnt],$English,addQuotes($lineItem)); break;
            case "tchinese": $TChinese=translate($Header[$LineCnt],$English,addQuotes($lineItem)); break;
            case "spanish": $Spanish=translate($Header[$LineCnt],$English,addQuotes($lineItem)); break;
          }
      }

    // TO:
    //Key,File,Type,UsedInMainMenu,NoTranslate,english,Context / Alternate Text,german,
    //   latam,french,italian,japanese,koreana,polish,brazilian,russian,turkish,schinese,tchinese,spanish

    // If we had to reformat the file due to bad-formatting, let's take a second stab at translation.
    $German=translate('german',$English,$German);
    $Latam=translate('latam',$English,$Latam);
    $French=translate('french',$English,$French);
    $Italian=translate('italian',$English,$Italian);
    $Japanese=translate('japanese',$English,$Japanese);
    $Koreana=translate('koreana',$English,$Koreana);
    $Polish=translate('polish',$English,$Polish);
    $Brazilian=translate('brazilian',$English,$Brazilian);
    $Russian=translate('russian',$English,$Russian);
    $Turkish=translate('turkish',$English,$Turkish);
    $SChinese=translate('schinese',$English,$SChinese);
    $TChinese=translate('tchinese',$English,$TChinese);
    $Spanish=translate('spanish',$English,$Spanish);

    // Output the line in the correct standardized format per A19's vanilla Localization.txt XML
    echo "$Key,$File,$Type,$UsedInMainMenu,$NoTranslate,$English,$AltText,$German,$Latam,$French,$Italian,$Japanese,$Koreana,$Polish,$Brazilian,$Russian,$Turkish,$SChinese,$TChinese,$Spanish\n";
  }

// This function performs the following functions:
//  - Converts all " to '
//  - Removes all quotations around the value
//  - Trims any whitespace at the front or end of the line
//  - Adds double-quotes around the value
function addQuotes($in)
{
  if(strlen($in)<1) return;
  $FirstChar=$in[0];
  $in=str_replace('"',"'",$in);
  $in=str_replace("''","'",$in);
  if($in[0]=="'") $in=substr($in,1,-1);
  $in=trim($in);
  $in="\"$in\"";
  return($in);
}

function translate($language,$English,$in)
{
  if(@strlen($in)>1) return($in);
  $in=$English;
  switch($language)
    { //latam,french,italian,japanese,koreana,polish,brazilian,russian,turkish,schinese,tchinese,spanish
      case "english": $langCode='en'; break;
      case "german": $langCode="de"; break;
      case "latam": $langCode="pt"; break;
      case "french": $langCode="fr"; break;
      case "italian": $langCode="it"; break;
      case "japanese": $langCode="ja"; break;
      case "koreana": $langCode="ko"; break;
      case "polish": $langCode="pl"; break;
      case "brazilian": $langCode="pt"; break;
      case "russian": $langCode="ru"; break;
      case "turkish": $langCode="tr"; break;
      case "schinese": $langCode="zh"; break;
      case "tchinese": $langCode="zh-TW"; break;
      case "spanish": $langCode="es"; break;
    }

  $out=str_replace("\r","",translateText($langCode, $English));
  $out="\"".str_replace("\n","",$out)."\"";
  return(addQuotes($out));
}

function translateText($langCode, $textToTranslate)
  {
  global $CACHEDIR, $APIKEY, $ENDPOINTURL;
  // If the IBM Watson Translation Config is not present, then assume we are NOT translating.
  if($CACHEDIR=="" || $APIKEY=="" || $ENDPOINTURL=="") return;

  // Check to see if there is a cached reply
  if(file_exists("$CACHEDIR/".sha1($langCode.$textToTranslate)))
    return(file_get_contents("$CACHEDIR/".sha1($langCode.$textToTranslate)));

  $ch = curl_init();

  curl_setopt($ch, CURLOPT_URL,$ENDPOINTURL);
  curl_setopt($ch, CURLOPT_USERPWD, "apikey:$APIKEY");
  # Setup request to send json via POST.
  $payload = json_encode( array("text"=>$textToTranslate, "source"=>"en", "target"=>$langCode) );
  curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
  curl_setopt($ch, CURLOPT_POST, 1);
  // Receive server response ...
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

  $server_output = curl_exec($ch);
  curl_close ($ch);

  #echo "*********************************************";
  #echo "SERVER OUTPUT:";
  #echo $server_output;

  # Decode and output response.
  $decodedArray=json_decode($server_output, true);
  #print_r($decodedArray);
  $output=trim($decodedArray['translations'][0]['translation']);
  // Cache Result for Next Query
  @file_put_contents("$CACHEDIR/".sha1($langCode.$textToTranslate),$output);
  return($output);
  }
?>
