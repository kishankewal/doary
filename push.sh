#!/bin/bash

if [-z "$1"]; then
echo "bash $0 <commit_message>"
fi

git add .
git commit -m "$1"
git push

