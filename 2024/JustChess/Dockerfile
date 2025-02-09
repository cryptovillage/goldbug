FROM alpine:latest

WORKDIR /workdir

ADD requirements.txt /workdir/requirements.txt
RUN apk update
RUN apk add python3 py3-pip --no-cache
RUN python -m venv env
RUN env/bin/python -m pip install -r requirements.txt

ADD . .

CMD [ "env/bin/python", "flask_app.py"]
