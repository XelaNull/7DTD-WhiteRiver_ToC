#!/usr/local/bin/php
<?php

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
      } // End if


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
              case "german": $German=''; break;
              case "latam": $Latam=''; break;
              case "french": $French=''; break;
              case "italian": $Italian=''; break;
              case "japanese": $Japanese=''; break;
              case "koreana": $Koreana=''; break;
              case "polish": $Polish=''; break;
              case "brazilian": $Brazilian=''; break;
              case "russian": $Russian=''; break;
              case "turkish": $Turkish=''; break;
              case "schinese": $SChinese=''; break;
              case "tchinese": $TChinese=''; break;
              case "spanish": $Spanish=''; break;
            } // End switch
        } // End foreach

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

?>
