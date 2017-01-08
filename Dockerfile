FROM debian

MAINTAINER Dickriven Chellemboyee

ADD . /odc
WORKDIR /odc
ENV DEBIAN_FRONTEND noninteractive

EXPOSE 8000

RUN apt-get update
RUN apt-get upgrade -y
RUN apt-get install -yqq apt-utils
RUN apt-get install -yqq php5 php5-curl php-soap libreoffice ghostscript pdftohtml
RUn apt-get clean -y

CMD ["php", "-S", "0.0.0.0:8000", "-t", "."]
