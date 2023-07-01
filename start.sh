#!/bin/bash

if grep -qi microsoft /proc/version; then
  ## Windows

  # Start Docker if not running
  if tasklist.exe | grep -q "docker"; then
      echo Docker already running
  else
      echo Starting Docker!
      '/mnt/c/Program Files/Docker/Docker/Docker Desktop.exe'&
  fi
else
  echo "native Linux"
fi

tmux new-session -d -s devapp 'docker compose up' \; \
  split-window -h 'npm run dev' \; \
  select-pane -t 1


tmux attach-session -t devapp
