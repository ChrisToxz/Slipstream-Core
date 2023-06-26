#!/bin/bash


# For windows
if tasklist.exe | grep -q "docker"; then
    echo Docker already running
else
    echo Starting Docker!
    '/mnt/c/Program Files/Docker/Docker/Docker Desktop.exe'&
fi


tmux new-session -d -s devapp 'php artisan serve | tee /dev/tty' \; \
      split-window -h 'npm run dev | tee -a /dev/tty' \; \
     select-pane -t 0

tmux attach-session -t devapp

