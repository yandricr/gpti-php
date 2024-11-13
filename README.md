
# GPTI

![packagist](https://poser.pugx.org/yandricr/gpti-php/downloads?style=for-the-badge) [![license](https://poser.pugx.org/yandricr/gpti-php/license?style=for-the-badge)](https://packagist.org/packages/yandricr/gpti-php) [![GitHub Stars](https://img.shields.io/github/stars/yandricr/gpti-php.svg?style=for-the-badge&label=Star)](https://github.com/yandricr/gpti-php) [![Package Size](https://img.shields.io/packagist/vpre/yandricr/gpti-php.svg?label=Package%20size&style=for-the-badge)](https://packagist.org/packages/yandricr/gpti-php) [![Contributors](https://img.shields.io/github/contributors/yandricr/gpti-php.svg?style=for-the-badge)](https://github.com/yandricr/gpti-php/graphs/contributors) [![PHP](https://img.shields.io/badge/php-grey?logo=php&style=for-the-badge)](https://packagist.org/packages/yandricr/gpti-php)

This package simplifies your interaction with various GPT models, eliminating the need for tokens or other methods to access GPT. It also allows you to use three artificial intelligences to generate images: DALL·E, Prodia, and more, some of which are premium while others are free, all of this without restrictions or limits.

## Installation

You can install the package via Composer

```bash
  composer require yandricr/gpti-php
```
## Available Models

GPTI provides access to a variety of artificial intelligence models to meet various needs. Currently, the available models include:

- [**ChatGPT**](#gpt)
- [**GPT-3.5-Turbo**](#gpt-v2)
- [**ChatGPT Web**](#gptweb)
- [**GPT-4o**](#gpt-4o)
- [**Bing**](#bing)
- [**LLaMA-3.1**](#llama-3.1)
- [**Blackbox**](#blackbox)
- [**AI Images**](#ai-images)

## Api key

If you want to access the premium models, enter your credentials. You can obtain them by [clicking here](https://nexra.aryahcr.cc/api-key/en).

```php
require "./vendor/autoload.php";

use gpti\...; // select model

$res = new ...();
$res->setAPI(user:"user-xxxxxxxx", secret:"nx-xxxxxxx-xxxxx-xxxxx");
```

<a id="gpt"></a>
## Usage GPT

```php
require "./vendor/autoload.php";

use gpti\gpt;

$res = new gpt(messages:array(
    [
        "role" => "assistant",
        "content" => "Hello! How are you today?"
    ],
    [
        "role" => "user",
        "content" => "Hello, my name is Yandri."
    ],
    [
        "role" => "assistant",
        "content" => "Hello, Yandri! How are you today?"
    ]
), prompt:"Can you repeat my name?", model:"GPT-4", markdown:false);
$res->execute();

if($res->error() != null){
    print(json_encode($res->error()));
} else {
    print(json_encode($res->result()));
}
```

#### Models

Select one of these available models in the API to enhance your experience.

- gpt-4
- gpt-4-0613
- gpt-4-32k
- gpt-4-0314
- gpt-4-32k-0314
- gpt-3.5-turbo
- gpt-3.5-turbo-16k
- gpt-3.5-turbo-0613
- gpt-3.5-turbo-16k-0613
- gpt-3.5-turbo-0301
- text-davinci-003
- text-davinci-002
- code-davinci-002
- gpt-3
- text-curie-001
- text-babbage-001
- text-ada-001
- davinci
- curie
- babbage
- ada
- babbage-002
- davinci-002

<a id="gpt-v2"></a>
## Usage GPT v2

It's quite similar, with the difference that it has the capability to generate real-time responses via streaming using gpt-3.5-turbo.

```php
require "./vendor/autoload.php";

use gpti\gptturbo;

$res = new gptturbo(messages:array(
    [
        "role" => "assistant",
        "content" => "Hello! How are you today?"
    ],
    [
        "role" => "user",
        "content" => "Hello, my name is Yandri."
    ],
    [
        "role" => "assistant",
        "content" => "Hello, Yandri! How are you today?"
    ],
    [
        "role" => "user",
        "content" => "Can you repeat my name?"
    ]
), markdown:false, stream:false);
$res->execute();

if($res->error() != null){
    print(json_encode($res->error()));
} else {
    print(json_encode($res->result()));
}
```

## Usage GPT v2 Streaming

```php
require "./vendor/autoload.php";

use gpti\gptturbo;

$res = new gptturbo(messages:array(
    [
        "role" => "assistant",
        "content" => "Hello! How are you today?"
    ],
    [
        "role" => "user",
        "content" => "Hello, my name is Yandri."
    ],
    [
        "role" => "assistant",
        "content" => "Hello, Yandri! How are you today?"
    ],
    [
        "role" => "user",
        "content" => "Can you repeat my name?"
    ]
), markdown:false, stream:true);
$res->execute();

if($res->error() != null){
    print(json_encode($res->error()));
} else {
    foreach($res->stream() as $data){
        print(json_encode($data));
    }
}
```

<a id="gptweb"></a>
## Usage GPT Web

GPT-4 has been enhanced by me, but errors may arise due to technological complexity. It is advisable to exercise caution when relying entirely on its accuracy for online queries.

```php
require "./vendor/autoload.php";

use gpti\gptweb;

$res = new gptweb(prompt:"Are you familiar with the movie Wonka released in 2023?", markdown:false);
$res->execute();

if($res->error() != null){
    print(json_encode($res->error()));
} else {
    print(json_encode($res->result()));
}
```

<a id="gpt-4o"></a>
## Usage GPT-4o

```php
require "./vendor/autoload.php";

use gpti\gpt4o;

$res = new gpt4o(messages:array(
    [
        "role" => "assistant",
        "content" => "Hello! How are you today?"
    ],
    [
        "role" => "user",
        "content" => "Hello, my name is Yandri."
    ],
    [
        "role" => "assistant",
        "content" => "Hello, Yandri! How are you today?"
    ],
    [
        "role" => "user",
        "content" => "Can you repeat my name?"
    ]
), markdown:false, stream:false);
$res->execute();

if($res->error() != null){
    print(json_encode($res->error()));
} else {
    print(json_encode($res->result()));
}
```

## Usage GPT-4o Streaming

```php
require "./vendor/autoload.php";

use gpti\gpt4o;

$res = new gpt4o(messages:array(
    [
        "role" => "assistant",
        "content" => "Hello! How are you today?"
    ],
    [
        "role" => "user",
        "content" => "Hello, my name is Yandri."
    ],
    [
        "role" => "assistant",
        "content" => "Hello, Yandri! How are you today?"
    ],
    [
        "role" => "user",
        "content" => "Can you repeat my name?"
    ]
), markdown:false, stream:true);
$res->execute();

if($res->error() != null){
    print(json_encode($res->error()));
} else {
    foreach($res->stream() as $data){
        print(json_encode($data));
    }
}
```

<a id="bing"></a>
## Usage Bing

```php
require "./vendor/autoload.php";

use gpti\bing;

$res = new bing(messages:array(
    [
        "role" => "assistant",
        "content" => "Hello! How can I help you today? 😊"
    ],
    [
        "role" => "user",
        "content" => "Hi, tell me the names of the movies released in 2023."
    ]
), conversation_style:"Balanced", markdown:false, stream:false);
$res->execute();

if($res->error() != null){
    print(json_encode($res->error()));
} else {
    print(json_encode($res->result()));
}
```

## Usage Bing Streaming

```php
require "./vendor/autoload.php";

use gpti\bing;

$res = new bing(messages:array(
    [
        "role" => "assistant",
        "content" => "Hello! How can I help you today? 😊"
    ],
    [
        "role" => "user",
        "content" => "Hi, tell me the names of the movies released in 2023."
    ]
), markdown:false, stream:true);
$res->execute();

if($res->error() != null){
    print(json_encode($res->error()));
} else {
    foreach($res->stream() as $data){
        print(json_encode($data));
    }
}
```

#### Parameters

| Parameter          | Default  | Description                                                                                             |
|--------------------|----------|---------------------------------------------------------------------------------------------------------|
| conversation_style | Balanced | You can use between: "Balanced", "Creative" and "Precise"                                               |
| markdown           | false    | You can convert the dialogues into continuous streams or not into Markdown                                |
| stream             | false    | You are given the option to choose whether you prefer the responses to be in real-time or not            |

<a id="llama-3.1"></a>
## Usage LLaMA 3.1

```php
require "./vendor/autoload.php";

use gpti\llama;

$res = new llama(messages:array(
    [
        "role" => "user",
        "content" => "Hello, my name is Yandri."
    ]
), conversation_style:"Balanced", markdown:false, stream:false);
$res->execute();

if($res->error() != null){
    print(json_encode($res->error()));
} else {
    print(json_encode($res->result()));
}
```

## Usage LLaMA 3.1 Streaming

```php
require "./vendor/autoload.php";

use gpti\llama;

$res = new llama(messages:array(
    [
        "role" => "user",
        "content" => "Hello, my name is Yandri."
    ]
), markdown:false, stream:true);
$res->execute();

if($res->error() != null){
    print(json_encode($res->error()));
} else {
    foreach($res->stream() as $data){
        print(json_encode($data));
    }
}
```

<a id="blackbox"></a>
## Usage blackbox

```php
require "./vendor/autoload.php";

use gpti\blackbox;

$res = new blackbox(messages:array(
    [
        "role" => "user",
        "content" => "Hello, my name is Yandri."
    ]
), conversation_style:"Balanced", markdown:false, stream:false);
$res->execute();

if($res->error() != null){
    print(json_encode($res->error()));
} else {
    print(json_encode($res->result()));
}
```

## Usage Blackbox Streaming

```php
require "./vendor/autoload.php";

use gpti\blackbox;

$res = new blackbox(messages:array(
    [
        "role" => "user",
        "content" => "Hello, my name is Yandri."
    ]
), markdown:false, stream:true);
$res->execute();

if($res->error() != null){
    print(json_encode($res->error()));
} else {
    foreach($res->stream() as $data){
        print(json_encode($data));
    }
}
```

<a id="ai-images"></a>
## AI Images

Check the documentation [here](https://nexra.aryahcr.cc/documentation/en) to learn how to use the different image generation models.

```php
require "./vendor/autoload.php";

use gpti\imageai;

$res = new imageai(prompt:"cat color red", model:"dalle", response:"url", data:[]);
$res->execute();

if($res->error() != null){
    print(json_encode($res->error()));
} else {
    print(json_encode($res->result()));
}
```

## API Reference

Currently, some models require your credentials to access them, while others are free. For more details and examples, please refer to the complete [documentation](https://nexra.aryahcr.cc/).

#### Code Errors

These are the error codes that will be presented in case the API fails.

| Code |                 Error | Description                                    |
|------|----------------------:|------------------------------------------------|
| 400  | BAD_REQUEST           | Not all parameters have been entered correctly |
| 500  | INTERNAL_SERVER_ERROR | The server has experienced failures            |
| 200  |                       | The API worked without issues                  |
| 403  | FORBIDDEN             | The API credentials are not valid              |
| 401  | UNAUTHORIZED          | API credentials are required                   |