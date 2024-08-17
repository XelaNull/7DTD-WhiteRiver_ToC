#!/bin/bash
export MODCOUNT

# Create Bash Function to handle the different downloads
function gdrive_download () {
  ((MODCOUNT++))
  mkdir $MODCOUNT
  echo "Download from gdrive: $1"
  CONFIRM=$(wget --quiet --save-cookies /tmp/cookies.txt --keep-session-cookies --no-check-certificate "https://docs.google.com/uc?export=download&id=$1" -O- | gsed -rn 's/.*confirm=([0-9A-Za-z_]+).*/\1\n/p')
  wget -q --load-cookies /tmp/cookies.txt "https://docs.google.com/uc?export=download&confirm=$CONFIRM&id=$1" -O $MODCOUNT/$2 > /dev/null 2>&1
  rm -rf /tmp/cookies.txt
  echo "https://docs.google.com/uc?export=download&id=$1" > $MODCOUNT/ModURL.txt
  cd $MODCOUNT
  [[ "$3" == "extract_file" ]] && extract_file $2
  echo "https://docs.google.com/uc?export=download&id=$1" > ModURL.txt
  cd ..
}

function git_clone () {
  ((MODCOUNT++))
  mkdir $MODCOUNT && cd $MODCOUNT
  export AUTHOR=`echo $1 | gsed 's|.git||g' | rev | cut -d'/' -f2 | rev | gsed 's|/||g'`
  export CLONED_INTO=`echo $1 | gsed 's|.git||g' | rev | cut -d'/' -f1 | rev`
  echo "GIT Cloning $AUTHOR's $CLONED_INTO.."
  # Delete the directory if it currently exists
  [[ -d $CLONED_INFO ]] && rm -rf $CLONED_INTO
  git clone $1 > /dev/null 2>&1
#  echo "$AUTHOR" > $CLONED_INTO/ModAUTHOR.txt
  echo "$1" > ModURL.txt
  cd ..
}
function svn_checkout () {
  ((MODCOUNT++))
  mkdir $MODCOUNT && cd $MODCOUNT
  echo "SVN Checkout of $1"
  svn checkout "$1" > /dev/null 2>&1
  echo "$1" | gsed 's|/trunk.*|/|' > ModURL.txt
  cd ..
}
function extract_file () {
  filename=$1
  extension="${filename##*.}"
  if [[ "$extension" == "rar" ]]; then unrar x -o+ $1 > /dev/null 2>&1
  elif [[ "$extension" == "gz" ]]; then tar -zxvf $1 > /dev/null 2>&1
  elif [[ "$extension" == "zip" ]]; then unzip -o $1 > /dev/null 2>&1
  elif [[ "$extension" == "7z" ]]; then 7z x $1 > /dev/null 2>&1
  fi
  rm -rf $1
}
function dropbox_download () {
  ((MODCOUNT++))
  mkdir $MODCOUNT && cd $MODCOUNT
  echo "Using CURL to download $1 and save as $2"
  curl -s -L "$1" > $2
  echo "$1" > ModURL.txt
  [[ "$3" == "extract_file" ]] && extract_file $2
  cd ..
}
function wget_download () {
  ((MODCOUNT++))
  mkdir $MODCOUNT && cd $MODCOUNT
  echo "Using WGET to download $1 and save as $2"
  wget -O $2 "$1" > /dev/null 2>&1
  echo "$1" > ModURL.txt
  [[ "$3" == "extract_file" ]] && extract_file $2
  cd ..
}
