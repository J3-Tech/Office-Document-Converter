FROM debian

MAINTAINER Dickriven Chellemboyee

ADD . /odc
WORKDIR /odc

EXPOSE 8000

RUN apt-get update
RUN apt-get upgrade -y
RUN apt-get install -y apt-utils
RUN apt-get install -y php5 php5-curl php-soap libreoffice ghostscript pdftohtml
RUn apt-get clean

CMD ["php", "-S", "0.0.0.0:8000", "-t", "."]
