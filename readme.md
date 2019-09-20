# Memoir

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/RichardTrujilloTorres/memoir/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/RichardTrujilloTorres/memoir/?branch=master)
[![Build Status](https://travis-ci.org/RichardTrujilloTorres/memoir.svg?branch=master)](https://travis-ci.org/RichardTrujilloTorres/memoir)
[![PHPStan](https://img.shields.io/badge/PHPStan-enabled-brightgreen.svg?style=flat)](https://github.com/phpstan/phpstan)

A history (micro) service.

## Introduction

Memoir is a basic history service.

Each record follows the form:
```json
{
    "_id": "5d7cfead84ae604bc63843f7",
    "contact": "/api/v1/contacts/1",
    "type": "product purchase made",
    "followUp": "special thank you email",
    "links": [
        "/api/v1/products/11"
    ],
    "updated_at": "2019-09-14 14:52:29",
    "created_at": "2019-09-14 14:52:29"
}
```

On record creation, only the contact and type fields are required.

Generally speaking, the intention is to have a fixed structure 
such as:
```json
{
    "contact": "contact service url",
    "type": "meaningful machine processable phrase",
    "extraField1": "content",
    "extraField2": "some more content"
}
```
In order to be consumed by the dependent services.


## Stack

Features:
- MongoDB
- Lumen 6.0

## Requirements

- Working MongoDB installation: developed using the 4.0.3

## Installation

```bash
git clone https://github.com/RichardTrujilloTorres/memoir
cd memoir
composer install
```

## Tests

```bash
./vendor/bin/phpunit
```

## License

Memoir is open-sourced software, licensed under the [MIT license](https://opensource.org/licenses/MIT).
