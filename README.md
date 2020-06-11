# Outlinks

## Requirements

1. Port 443 open on your local machine
2. Either:
    * Docker
    * A locally-running web server capable of serving pages over SSL

## Installation

### 1. Route traffic to your local machine

Add to your hosts file (`/etc/hosts`, etc.):

```
127.0.0.1 outlinks.example.com  # replace with the hostname you want to route
```

### 2a. Docker instructions

1. `docker-compose up -d`
2. There is no step 2
3. Well, you'll need to tell your browser to trust the self-signed cert

### 2b. Non-docker instructions

1. Configure a web server to support SSL and listen on port 443
2. Point your web server to the `public` directory in this project

### 3. Created an allowed domains list

1. Copy `public/allowed.sample.json` to `public/allowed.json`.
2. Modify to include domains for which you want allow automatic redirects.

### 4. Install UI assets

```sh
npm Install
```
