#!/bin/bash
#. ../../download_mods.func.sh
. ../download_mods.func.sh
#. download_mods.func.sh

echo "###################################"
echo "GENERATING COMBINED MODLET"

# Create the CombinedModlet folder
rm -rf CombinedModlet extracted_7DTD-WhiteRiverToC-combined; mkdir -p CombinedModlet/Config/XUi
echo "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>
<xml>
	<ModInfo>
		<Name value=\"White River - Tools of Citizenship\" />
		<Description value=\"Extend White River quest line to allow player to craft fabled equipment through collecting a lot of resources.\" />
		<Author value=\"Created by Shouden Kalferas and many others (see README)\" />
		<Version value=\"A20_1.0e\" />
		<Website value=\"https://community.7daystodie.com/topic/12269-white-river-tools-of-citizenship-quests-a196-with-df-multiple-languages\" />
	</ModInfo>
</xml>" > CombinedModlet/ModInfo.xml

find Mods -name 'ModInfo.xml' -exec echo {} \; > ModInfo.txt
sed 's:[^/]*$::' ModInfo.txt > ModsUnsorted.txt; rm -rf ModInfo.txt
cat ModsUnsorted.txt | sort > ModletList.txt; rm -rf ModsUnsorted.txt
while read moddir; do
  ## If localization.txt exists, we should copy it to the combined file
  #echo $moddir;

  # Extract Mod Info
  NAME=`grep Name "$moddir/ModInfo.xml" | grep -o '".*"' | tr -d '"'`
  AUTHOR=`grep Author "$moddir/ModInfo.xml" | grep -o '".*"' | tr -d '"'`
  WEBSITE=`grep Website "$moddir/ModInfo.xml" | grep -o '".*"' | tr -d '"'`
	DLURL=`cat "$moddir/ModURL.txt"`
  DESCRIPTION=`grep Description "$moddir/ModInfo.xml" | grep -o '".*"' | tr -d '"'`
  # Write Mod and Author Data to README.md file
  echo "- $NAME by **$AUTHOR**" >> CombinedModlet/MODLIST.md
	echo "" >> CombinedModlet/MODLIST.md
  if [[ ! -z $WEBSITE ]]; then echo "  - Website: $WEBSITE" >> CombinedModlet/MODLIST.md; fi
	echo "  - Download URL: $DLURL" >> CombinedModlet/MODLIST.md
  echo "  - Description: $DESCRIPTION" >> CombinedModlet/MODLIST.md
	echo "" >> CombinedModlet/MODLIST.md

  # Handle Files named "Localization.txt"
  if [[ -f $moddir/Config/Localization.txt ]]; then
    if [[ ! -f CombinedModlet/Config/Localization.txt ]]; then
      echo "Key,File,Type,UsedInMainMenu,NoTranslate,english,Context / Alternate Text,german,latam,french,italian,japanese,koreana,polish,brazilian,russian,turkish,schinese,tchinese,spanish" > CombinedModlet/Config/Localization.txt
    fi
    echo "" >> CombinedModlet/Config/Localization.txt
    ../parse-localization.php "$moddir/Config/Localization.txt" >> CombinedModlet/Config/Localization.txt
  fi
  # Handle Files named "localization.txt"
  #if [[ -f $moddir/Config/localization.txt ]]; then
  #  if [[ ! -f CombinedModlet/Config/localization.txt ]]; then
  #    echo "Key,File,Type,UsedInMainMenu,NoTranslate,english,Context / Alternate Text,german,latam,french,italian,japanese,koreana,polish,brazilian,russian,turkish,schinese,tchinese,spanish" > CombinedModlet/Config/Localization.txt
  #  fi
  #  echo "" >> CombinedModlet/Config/Localization.txt
  #  cat "$moddir/Config/localization.txt" >> CombinedModlet/Config/Localization.txt
  #fi

  ## Find all XML files under the Mod Folder
  find "$moddir/Config" -name *.xml ! -name ModInfo.xml > MODXMLs.txt
  while read xmlfile; do
    BASENAME=`echo "$xmlfile" | cut -d'/' -f3-`
    cat "$xmlfile" | gsed -e :a -re 's/<!--.*?-->//g;/<!--/N;//ba' > NOCOMMENTS_XMLFILE
    cat NOCOMMENTS_XMLFILE | awk 'NF' > NOBLANK_XMLFILE; rm -rf NOCOMMENTS_XMLFILE

    cat NOBLANK_XMLFILE | grep '\S' > XMLFILE
    gsed -i '1d' XMLFILE
    gsed -i '$ d' XMLFILE

    echo "$moddir/Config/$BASENAME"

    if [[ ! -f CombinedModlet/$BASENAME ]]; then
      echo "<configs>" >> CombinedModlet/$BASENAME
    fi
    echo "<!-- #################################### -->" >> CombinedModlet/$BASENAME
    echo "<!-- START $NAME by $AUTHOR -->" >> CombinedModlet/$BASENAME
    if [[ ! -z $WEBSITE ]]; then echo "<!-- Website: $WEBSITE -->" >> CombinedModlet/$BASENAME; fi
		echo "<!-- Download URL: $DLURL -->" >> CombinedModlet/$BASENAME
    # INSERT JUST TO XMLFILE WITHOUT OPENING AND CLOSING XML TAGS
    cat XMLFILE | awk 'NF' > NOBLANK_XMLFILE ;
    gsed -i "/^ *$/d" NOBLANK_XMLFILE
    cat NOBLANK_XMLFILE >> CombinedModlet/$BASENAME; rm -rf XMLFILE NOBLANK_XMLFILE;
    echo "<!-- END $NAME by $AUTHOR -->" >> CombinedModlet/$BASENAME
    echo "" >> CombinedModlet/$BASENAME
    echo "" >> CombinedModlet/$BASENAME
  done < MODXMLs.txt; rm -rf MODXMLs.txt
done < ModletList.txt;

# Create README.md
#cp ../HEADER.md CombinedModlet/README.md
#sed -i -e '/INSERT/{r CombinedModlet/MODLIST.md' -e 'd}' CombinedModlet/README.md
#rm -rf CombinedModlet/MODLIST.md

find "CombinedModlet/Config" -name *.xml > MODXMLs.txt
while read xmlfile; do
  echo "</configs>" >> $xmlfile
done < MODXMLs.txt; rm -rf MODXMLs.txt

mv CombinedModlet 7DTD-WhiteRiverToC-combined
zip -r $(date +%Y-%d-%m_%H%M%S)-7DTD-WhiteRiverToC-combined.zip 7DTD-WhiteRiverToC-combined
mv 7DTD-WhiteRiverToC-combined extracted_7DTD-WhiteRiverToC-combined

# Publish to standalone repo
cp -rp extracted_7DTD-WhiteRiverToC-combined/* ../../7DTD-WhiteRiver_ToC-combined/WhiteRiverToC-combined/
rm -rf ../../7DTD-WhiteRiver_ToC-combined/README.md
mv ../../7DTD-WhiteRiver_ToC-combined/MODLIST.md ../../7DTD-WhiteRiver_ToC-combined/README.md
