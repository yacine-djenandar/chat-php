git init
git remote add origin https://github.com/samyblm/Gestion-des-Conf-rences.git
git pull origin master
git pull origin main
git config --global user.email "yacinejnano@gmail.com"
git pull origin main
git add .
git commit -m "zedna f frontend"
git push origin HEAD:main
###-begin-pm2-completion-###
### credits to npm for the completion file model
#
# Installation: pm2 completion >> ~/.bashrc  (or ~/.zshrc)
#
COMP_WORDBREAKS=${COMP_WORDBREAKS/=/}
COMP_WORDBREAKS=${COMP_WORDBREAKS/@/}
export COMP_WORDBREAKS
if type complete &>/dev/null; then   _pm2_completion () {     local si="$IFS";     IFS=$'\n' COMPREPLY=($(COMP_CWORD="$COMP_CWORD" \
                           COMP_LINE="$COMP_LINE" \
                           COMP_POINT="$COMP_POINT" \
                           pm2 completion -- "${COMP_WORDS[@]}" \
                           2>/dev/null)) || return $?;     IFS="$si";   };   complete -o default -F _pm2_completion pm2; elif type compctl &>/dev/null; then   _pm2_completion () {     local cword line point words si;     read -Ac words;     read -cn cword;     let cword-=1;     read -l line;     read -ln point;     si="$IFS";     IFS=$'\n' reply=($(COMP_CWORD="$cword" \
                       COMP_LINE="$line" \
                       COMP_POINT="$point" \
                       pm2 completion -- "${words[@]}" \
                       2>/dev/null)) || return $?;     IFS="$si";   };   compctl -K _pm2_completion + -f + pm2; fi
###-end-pm2-completion-###
#!/bin/sh
# *****************************************************************************
#
# Pentaho Data Integration
#
# Copyright (C) 2014 - 2021 by Hitachi Vantara : http://www.hitachivantara.com
#
# *****************************************************************************
#
# Licensed under the Apache License, Version 2.0 (the "License");
# you may not use this file except in compliance with
# the License. You may obtain a copy of the License at
#
#    http://www.apache.org/licenses/LICENSE-2.0
#
# Unless required by applicable law or agreed to in writing, software
# distributed under the License is distributed on an "AS IS" BASIS,
# WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
# See the License for the specific language governing permissions and
# limitations under the License.
#
# *****************************************************************************
echo "SpoonDebug is to support you in finding unusual errors and start problems."
echo "-"
echo "Set logging level to Debug? (default: Basic logging)"
echo "Debug? (Y=Yes, N=No, C=Cancel)"
while true ; do     read ync;     case $ync in         Y* ) SPOON_OPTIONS="-level=Debug";export SPOON_OPTIONS;break;;         N* ) break;;         C* ) exit;;         * ) exit;;     esac; done
#!/bin/sh
#
#  HITACHI VANTARA PROPRIETARY AND CONFIDENTIAL
# 
#  Copyright 2002 - 2021 Hitachi Vantara. All rights reserved.
# 
#  NOTICE: All information including source code contained herein is, and
#  remains the sole property of Hitachi Vantara and its licensors. The intellectual
#  and technical concepts contained herein are proprietary and confidential
#  to, and are trade secrets of Hitachi Vantara and may be covered by U.S. and foreign
#  patents, or patents in process, and are protected by trade secret and
#  copyright laws. The receipt or possession of this source code and/or related
#  information does not convey or imply any rights to reproduce, disclose or
#  distribute its contents, or to manufacture, use, or sell anything that it
#  may describe, in whole or in part. Any reproduction, modification, distribution,
#  or public display of this information without the express written authorization
#  from Hitachi Vantara is strictly prohibited and in violation of applicable laws and
#  international treaties. Access to the source code contained herein is strictly
#  prohibited to anyone except those individuals and entities who have executed
#  confidentiality and non-disclosure agreements or other agreements with Hitachi Vantara,
#  explicitly covering such access.
DIR="`pwd`"
echo "$KETTLE_HOME"
if [ ! -z "$KETTLE_HOME" ] # not blank; then 	if [[ ! "$KETTLE_HOME" = /* ]] # not full path; 	then 		export KETTLE_HOME="$DIR/$KETTLE_HOME"; 	fi; fi
if [ ! -d "$KETTLE_HOME" ] # not found; then 	export KETTLE_HOME=; fi
echo "$KETTLE_HOME"
export IS_YARN="true"
BASEDIR="`dirname $0`"
"$BASEDIR/carte.sh" "$@"
