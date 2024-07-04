
# GPTI

![packagist](https://poser.pugx.org/yandricr/gpti-php/downloads?style=for-the-badge) [![license](https://poser.pugx.org/yandricr/gpti-php/license?style=for-the-badge)](https://packagist.org/packages/yandricr/gpti-php) [![GitHub Stars](https://img.shields.io/github/stars/yandricr/gpti-php.svg?style=for-the-badge&label=Star)](https://github.com/yandricr/gpti-php) [![Package Size](https://img.shields.io/packagist/vpre/yandricr/gpti-php.svg?label=Package%20size&style=for-the-badge)](https://packagist.org/packages/yandricr/gpti-php) [![Contributors](https://img.shields.io/github/contributors/yandricr/gpti-php.svg?style=for-the-badge)](https://github.com/yandricr/gpti-php/graphs/contributors) [![PHP](https://img.shields.io/badge/php-grey?logo=php&style=for-the-badge)](https://packagist.org/packages/yandricr/gpti-php)
 [![Ko-Fi](https://img.shields.io/badge/Ko--fi-F16061?style=for-the-badge&logo=ko-fi&logoColor=white)](https://ko-fi.com/yandricr)

This package simplifies your interaction with various GPT models, eliminating the need for tokens or other methods to access GPT. It also allows you to use three artificial intelligences to generate images: DALL·E, Prodia, and more, some of which are premium while others are free, all of this without restrictions or limits.

## Installation

You can install the package via Composer

```bash
  composer require yandricr/gpti-php
```
## Available Models

GPTI provides access to a variety of artificial intelligence models to meet various needs. Currently, the available models include:

- [**ChatGPT**](#gpt)
- [**ChatGPT v2**](#gpt-v2)
- [**ChatGPT Web**](#gptweb)
- [**Bing**](#bing)
- [**DALL·E**](#dalle)
- [**DALL-E 2**](#dalle2) (PRO)
- [**DALL-E Mini**](#dalle-mini)
- [**Prodia**](#prodia)
- [**Prodia Stable-Diffusion**](#prodia-stablediffusion)
- [**Prodia Stable-Diffusion XL**](#prodia-stablediffusion-xl) (PRO)
- [**Pixart-A**](#pixart-a) (PRO)
- [**Pixart-LCM**](#pixart-lcm) (PRO)
- [**Stable-Diffusion 1.5**](#stablediffusion-1.5)
- [**Stable-Diffusion 2.1**](#stablediffusion-2.1)
- [**Stable-Diffusion XL**](#stablediffusion-xl) (PRO)
- [**EMI**](#emi)
- [**Render3D**](#render3d) (PRO)
- [**PixelArt**](#pixelart)  (PRO)
- [**Animagine-XL**](#animagine-xl) (PRO)
- [**Playground**](#playground) (PRO)

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

#### JSON

```json
{
    "code": 200,
    "status": true,
    "model": "gpt-4",
    "gpt": "Hello, Yandri! How can I assist you today?",
    "original": null
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

use gpti\gptv2;

$res = new gptv2(messages:array(
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

#### JSON

```json
{
    "code": 200,
    "status": true,
    "model": "ChatGPT",
    "message": "Of course, Yandri! How can I assist you today?",
    "original": null
}
```

## Usage GPT v2 Streaming

```php
require "./vendor/autoload.php";

use gpti\gptv2;

$res = new gptv2(messages:array(
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

#### JSON

```json
{"message":"","original":null,"finish":false,"error":false}
{"message":"Of","original":null,"finish":false,"error":false}
{"message":"Of course","original":null,"finish":false,"error":false}
{"message":"Of course,","original":null,"finish":false,"error":false}
{"message":"Of course, Yand","original":null,"finish":false,"error":false}
{"message":"Of course, Yandri","original":null,"finish":false,"error":false}
{"message":"Of course, Yandri!","original":null,"finish":false,"error":false}
{"message":"Of course, Yandri! How","original":null,"finish":false,"error":false}
{"message":"Of course, Yandri! How can","original":null,"finish":false,"error":false}
{"message":"Of course, Yandri! How can I","original":null,"finish":false,"error":false}
{"message":"Of course, Yandri! How can I assist","original":null,"finish":false,"error":false}
{"message":"Of course, Yandri! How can I assist you","original":null,"finish":false,"error":false}
{"message":"Of course, Yandri! How can I assist you today","original":null,"finish":false,"error":false}
{"message":"Of course, Yandri! How can I assist you today?","original":null,"finish":false,"error":false}
{"message":"Of course, Yandri! How can I assist you today?","original":null,"finish":false,"error":false}
{"message":"Of course, Yandri! How can I assist you today?","original":null,"finish":false,"error":false}
{"message":null,"original":null,"finish":true,"error":false}
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

#### JSON

```json
{
    "code": 200,
    "status": true,
    "gpt": "Yes, I am familiar with the movie Wonka released in 2023. Wonka is a musical fantasy film directed by Paul King, adapted from the character at the center of Roald Dahl's iconic children's book, \"Charlie and the Chocolate Factory.\" The film follows the story of a young and poor Willy Wonka as he dreams of opening a shop in a chocolate-renowned city and discovers that the industry is controlled by a greedy cartel. The film has a rating of 7.1/10 and has received positive reviews with a score of 83% on Rotten Tomatoes. It was released on December 15, 2023, and has earned $552.1 million at the box office. The cast includes actors such as Timothée Chalamet. Unfortunately, I couldn't find information on whether the movie is available on Netflix.",
    "original": null
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
    ],
    [
        "role" => "assistant",
        "content" => "Certainly! Here are some movies that were released in 2023:\n\n1.  **About My Father** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n2.  **The Little Mermaid** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n3.  **Fast X** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n4.  **Spider-Man: Across the Spider-Verse** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n5.  **The Machine** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n6.  **Book Club: The Next Chapter** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n7.  **Guardians of the Galaxy Vol. 3** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n8.  **John Wick: Chapter 4** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n9.  **Are You There God? It's Me, Margaret** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n10.  **Evil Dead Rise** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n11.  **The Super Mario Bros. Movie** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n12.  **Love Again** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n13.  **Kandahar** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n14.  **Dungeons & Dragons: Honor Among Thieves** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n15.  **Shin Kamen Rider** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n16.  **Knights of the Zodiac** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n17.  **The Pope's Exorcist** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n18.  **Shazam! Fury of the Gods** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n19.  **All That Breathes** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n20.  **Sailor Moon Cosmos** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n21.  **Hypnotic** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n22.  **Sound of Freedom** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n23.  **The Boogeyman** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n24.  **Chicken Run: Dawn of the Nugget** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n25.  **A Lot of Nothing** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n26.  **Followers** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n27.  **Big George Foreman** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n28.  **Asterix & Obelix: The Middle Kingdom** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n29.  **Ant-Man and the Wasp: Quantumania** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n30.  **Transformers: Rise of the Beasts** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n31.  **Follow Her** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n32.  **Prom Pact** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n33.  **God Is a Bullet** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n34.  **Still: A Michael J. Fox Movie** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n35.  **Nefarious** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n36.  **Nanny Dearest** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n37.  **Monica** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n38.  **Wild Life** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n39.  **Palm Trees and Power Lines** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n40.  **What's Love Got to Do with It?** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n41.  **Creed III** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n42.  **One True Loves** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n43.  **BlackBerry** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n44.  **Suzume** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n45.  **Rock Dog 3: Battle the Beat** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n46.  **Gridman Universe** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n47.  **Digimon Adventure 02: The Beginning** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n48.  **Woman of the Photographs** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n49.  **El Tonto** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n50.  **Seriously Red** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n\nI hope this helps! Let me know if you have any other questions."
    ],
    [
        "role" => "user",
        "content" => "Can you tell me how many movies you've told me about?"
    ]
), conversation_style:"Balanced", markdown:false, stream:false);
$res->execute();

if($res->error() != null){
    print(json_encode($res->error()));
} else {
    print(json_encode($res->result()));
}
```

#### JSON

```json
{
    "code": 200,
    "status": true,
    "model": "Bing",
    "message": "I have told you about **50 movies** that were released in 2023. Is there anything else I can help you with?",
    "original:": null
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
    ],
    [
        "role" => "assistant",
        "content" => "Certainly! Here are some movies that were released in 2023:\n\n1.  **About My Father** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n2.  **The Little Mermaid** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n3.  **Fast X** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n4.  **Spider-Man: Across the Spider-Verse** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n5.  **The Machine** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n6.  **Book Club: The Next Chapter** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n7.  **Guardians of the Galaxy Vol. 3** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n8.  **John Wick: Chapter 4** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n9.  **Are You There God? It's Me, Margaret** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n10.  **Evil Dead Rise** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n11.  **The Super Mario Bros. Movie** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n12.  **Love Again** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n13.  **Kandahar** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n14.  **Dungeons & Dragons: Honor Among Thieves** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n15.  **Shin Kamen Rider** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n16.  **Knights of the Zodiac** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n17.  **The Pope's Exorcist** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n18.  **Shazam! Fury of the Gods** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n19.  **All That Breathes** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n20.  **Sailor Moon Cosmos** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n21.  **Hypnotic** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n22.  **Sound of Freedom** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n23.  **The Boogeyman** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n24.  **Chicken Run: Dawn of the Nugget** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n25.  **A Lot of Nothing** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n26.  **Followers** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n27.  **Big George Foreman** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n28.  **Asterix & Obelix: The Middle Kingdom** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n29.  **Ant-Man and the Wasp: Quantumania** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n30.  **Transformers: Rise of the Beasts** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n31.  **Follow Her** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n32.  **Prom Pact** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n33.  **God Is a Bullet** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n34.  **Still: A Michael J. Fox Movie** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n35.  **Nefarious** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n36.  **Nanny Dearest** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n37.  **Monica** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n38.  **Wild Life** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n39.  **Palm Trees and Power Lines** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n40.  **What's Love Got to Do with It?** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n41.  **Creed III** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n42.  **One True Loves** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n43.  **BlackBerry** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n44.  **Suzume** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n45.  **Rock Dog 3: Battle the Beat** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n46.  **Gridman Universe** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n47.  **Digimon Adventure 02: The Beginning** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n48.  **Woman of the Photographs** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n49.  **El Tonto** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n50.  **Seriously Red** [^1^](https://editorial.rottentomatoes.com/guide/best-movies-of-2023/)\n\nI hope this helps! Let me know if you have any other questions."
    ],
    [
        "role" => "user",
        "content" => "Can you tell me how many movies you've told me about?"
    ]
), conversation_style:"Balanced", markdown:false, stream:true);
$res->execute();

if($res->error() != null){
    print(json_encode($res->error()));
} else {
    foreach($res->stream() as $data){
        print(json_encode($data));
    }
}
```

```json
{"message":"I","original":null,"finish":false,"error":false}
{"message":"I have","original":null,"finish":false,"error":false}
{"message":"I have told","original":null,"finish":false,"error":false}
{"message":"I have told you","original":null,"finish":false,"error":false}
{"message":"I have told you about","original":null,"finish":false,"error":false}
{"message":"I have told you about \\*\\*","original":null,"finish":false,"error":false}
{"message":"I have told you about \\*\\*50","original":null,"finish":false,"error":false}
{"message":"I have told you about \\*\\*50 movies","original":null,"finish":false,"error":false}
{"message":"I have told you about **50 movies**","original":null,"finish":false,"error":false}
{"message":"I have told you about **50 movies** that","original":null,"finish":false,"error":false}
{"message":"I have told you about **50 movies** that were","original":null,"finish":false,"error":false}
{"message":"I have told you about **50 movies** that were released","original":null,"finish":false,"error":false}
{"message":"I have told you about **50 movies** that were released in","original":null,"finish":false,"error":false}
{"message":"I have told you about **50 movies** that were released in","original":null,"finish":false,"error":false}
{"message":"I have told you about **50 movies** that were released in 202","original":null,"finish":false,"error":false}
{"message":"I have told you about **50 movies** that were released in 2023","original":null,"finish":false,"error":false}
{"message":"I have told you about **50 movies** that were released in 2023.","original":null,"finish":false,"error":false}
{"message":"I have told you about **50 movies** that were released in 2023. Is","original":null,"finish":false,"error":false}
{"message":"I have told you about **50 movies** that were released in 2023. Is there","original":null,"finish":false,"error":false}
{"message":"I have told you about **50 movies** that were released in 2023. Is there anything","original":null,"finish":false,"error":false}
{"message":"I have told you about **50 movies** that were released in 2023. Is there anything else","original":null,"finish":false,"error":false}
{"message":"I have told you about **50 movies** that were released in 2023. Is there anything else I","original":null,"finish":false,"error":false}
{"message":"I have told you about **50 movies** that were released in 2023. Is there anything else I can","original":null,"finish":false,"error":false}
{"message":"I have told you about **50 movies** that were released in 2023. Is there anything else I can help","original":null,"finish":false,"error":false}
{"message":"I have told you about **50 movies** that were released in 2023. Is there anything else I can help you","original":null,"finish":false,"error":false}
{"message":"I have told you about **50 movies** that were released in 2023. Is there anything else I can help you with","original":null,"finish":false,"error":false}
{"message":"I have told you about **50 movies** that were released in 2023. Is there anything else I can help you with?","original":null,"finish":false,"error":false}
{"message":"I have told you about **50 movies** that were released in 2023. Is there anything else I can help you with?","original":null,"finish":false,"error":false}
{"message":"I have told you about **50 movies** that were released in 2023. Is there anything else I can help you with?","original":null,"finish":false,"error":false}
{"message":"I have told you about **50 movies** that were released in 2023. Is there anything else I can help you with?","original":null,"finish":false,"error":false}
{"message":null,"original":null,"finish":true,"error":false}
```

#### Parameters

| Parameter          | Default  | Description                                                                                             |
|--------------------|----------|---------------------------------------------------------------------------------------------------------|
| conversation_style | Balanced | You can use between: "Balanced", "Creative" and "Precise"                                               |
| markdown           | false    | You can convert the dialogues into continuous streams or not into Markdown                                |
| stream             | false    | You are given the option to choose whether you prefer the responses to be in real-time or not            |

<a id="dalle"></a>
## Usage DALL·E

```php
require "./vendor/autoload.php";

use gpti\dalle;

$res = new dalle(prompt:"starry sky over the city");
$res->execute();

if($res->error() != null){
    print(json_encode($res->error()));
} else {
    print(json_encode($res->result()));
}
```

#### JSON

```json
{
    "code": 200,
    "status": true,
    "prompt": "starry sky over the city",
    "model": "DALL·E",
    "images": [
        "data:image/jpeg;base64,..."
    ]
}
```

<a id="dalle2"></a>
## Usage DALL·E 2 (PRO)

```php
require "./vendor/autoload.php";

use gpti\dalle2;

$res = new dalle2(prompt:"An extensive green valley stretches toward imposing mountains, adorned with meadows and a winding stream. The morning sun paints the sky with warm tones, illuminating the landscape with a serenity that invites contemplation and peace.", data:array(
    "prompt_negative" => "",
    "width" => 1024,
    "height" => 1024,
    "guidance_scale" => 6
));
$res->execute();

if($res->error() != null){
    print(json_encode($res->error()));
} else {
    print(json_encode($res->result()));
}
```

#### JSON

```json
{
    "code": 200,
    "status": true,
    "prompt": "An extensive green valley stretches toward imposing mountains, adorned with meadows and a winding stream. The morning sun paints the sky with warm tones, illuminating the landscape with a serenity that invites contemplation and peace.",
    "model": "DALL·E-2",
    "data": {
        "prompt_negative": "(deformed, distorted, disfigured:1.3), poorly drawn, bad anatomy, wrong anatomy, extra limb, missing limb, floating limbs, (mutated hands and fingers:1.4), disconnected limbs, mutation, mutated, ugly, disgusting, blurry, amputation, (NSFW:1.25)",
        "width": 1024,
        "height": 1024,
        "guidance_scale": 6
    },
    "images": [
        "data:image/jpeg;base64,..."
    ]
}
```

#### Parameters

| Parameter       | Default                                                                                                    | Description                                                            |
|-----------------|------------------------------------------------------------------------------------------------------------|------------------------------------------------------------------------|
| prompt_negative| (deformed, distorted, disfigured:1.3), poorly drawn, bad anatomy, wrong anatomy, extra limb, missing limb, floating limbs, (mutated hands and fingers:1.4), disconnected limbs, mutation, mutated, ugly, disgusting, blurry, amputation, (NSFW:1.25) | Indicates what the AI should not do                                    |
| width           | 1024                                                                                                       | Min: 512, Max: 2048                                                   |
| height          | 1024                                                                                                       | Min: 512, Max: 2048                                                   |
| guidance_scale  | 6                                                                                                          | Min: 0.1, Max: 20                                                      |

<a id="dalle-mini"></a>
## Usage DALL·E Mini

```php
require "./vendor/autoload.php";

use gpti\dalle_mini;

$res = new dalle_mini(prompt:"An extensive green valley stretches toward imposing mountains, adorned with meadows and a winding stream. The morning sun paints the sky with warm tones, illuminating the landscape with a serenity that invites contemplation and peace.");
$res->execute();

if($res->error() != null){
    print(json_encode($res->error()));
} else {
    print(json_encode($res->result()));
}
```

#### JSON

```json
{
    "code": 200,
    "status": true,
    "prompt": "An extensive green valley stretches toward imposing mountains, adorned with meadows and a winding stream. The morning sun paints the sky with warm tones, illuminating the landscape with a serenity that invites contemplation and peace.",
    "model": "DALL·E-mini",
    "images": [
        "data:image/jpeg;base64,...",
        "..."
    ]
}
```

<a id="prodia"></a>
## Usage Prodia

```php
require "./vendor/autoload.php";

use gpti\prodia;

$res = new prodia(prompt:"Friends gathered around a bonfire in an ancient forest. Laughter, stories, and a starry sky paint an unforgettable moment of connection beneath the shadows of the mountains.", data:array(
    "model" => "absolutereality_V16.safetensors [37db0fc3]",
    "steps" => 25,
    "cfg_scale" => 7,
    "sampler" => "DPM++ 2M Karras",
    "negative_prompt" => ""
));
$res->execute();

if($res->error() != null){
    print(json_encode($res->error()));
} else {
    print(json_encode($res->result()));
}
```

### JSON

```json
{
    "code": 200,
    "status": true,
    "prompt": "Friends gathered around a bonfire in an ancient forest. Laughter, stories, and a starry sky paint an unforgettable moment of connection beneath the shadows of the mountains.",
    "model": "Prodia",
    "data": {
        "model": "absolutereality_V16.safetensors [37db0fc3]",
        "steps": 25,
        "cfg_scale": 7,
        "sampler": "DPM++ 2M Karras",
        "negative_prompt": ""
    },
    "images": [
        "data:image/jpeg;base64,..."
    ]
}
```


#### Models

List of models

- 3Guofeng3_v34.safetensors [50f420de]
- absolutereality_V16.safetensors [37db0fc3]
- absolutereality_v181.safetensors [3d9d4d2b]
- amIReal_V41.safetensors [0a8a2e61]
- analog-diffusion-1.0.ckpt [9ca13f02]
- anythingv3_0-pruned.ckpt [2700c435]
- anything-v4.5-pruned.ckpt [65745d25]
- anythingV5_PrtRE.safetensors [893e49b9]
- AOM3A3_orangemixs.safetensors [9600da17]
- blazing_drive_v10g.safetensors [ca1c1eab]
- breakdomain_I2428.safetensors [43cc7d2f]
- breakdomain_M2150.safetensors [15f7afca]
- cetusMix_Version35.safetensors [de2f2560]
- childrensStories_v13D.safetensors [9dfaabcb]
- childrensStories_v1SemiReal.safetensors [a1c56dbb]
- childrensStories_v1ToonAnime.safetensors [2ec7b88b]
- Counterfeit_v30.safetensors [9e2a8f19]
- cuteyukimixAdorable_midchapter3.safetensors [04bdffe6]
- cyberrealistic_v33.safetensors [82b0d085]
- dalcefo_v4.safetensors [425952fe]
- deliberate_v2.safetensors [10ec4b29]
- deliberate_v3.safetensors [afd9d2d4]
- dreamlike-anime-1.0.safetensors [4520e090]
- dreamlike-diffusion-1.0.safetensors [5c9fd6e0]
- dreamlike-photoreal-2.0.safetensors [fdcf65e7]
- dreamshaper_6BakedVae.safetensors [114c8abb]
- dreamshaper_7.safetensors [5cf5ae06]
- dreamshaper_8.safetensors [9d40847d]
- edgeOfRealism_eorV20.safetensors [3ed5de15]
- EimisAnimeDiffusion_V1.ckpt [4f828a15]
- elldreths-vivid-mix.safetensors [342d9d26]
- epicphotogasm_xPlusPlus.safetensors [1a8f6d35]
- epicrealism_naturalSinRC1VAE.safetensors [90a4c676]
- epicrealism_pureEvolutionV3.safetensors [42c8440c]
- ICantBelieveItsNotPhotography_seco.safetensors [4e7a3dfd]
- indigoFurryMix_v75Hybrid.safetensors [91208cbb]
- juggernaut_aftermath.safetensors [5e20c455]
- lofi_v4.safetensors [ccc204d6]
- lyriel_v16.safetensors [68fceea2]
- majicmixRealistic_v4.safetensors [29d0de58]
- mechamix_v10.safetensors [ee685731]
- meinamix_meinaV9.safetensors [2ec66ab0]
- meinamix_meinaV11.safetensors [b56ce717]
- neverendingDream_v122.safetensors [f964ceeb]
- openjourney_V4.ckpt [ca2f377f]
- pastelMixStylizedAnime_pruned_fp16.safetensors [793a26e8]
- portraitplus_V1.0.safetensors [1400e684]
- protogenx34.safetensors [5896f8d5]
- Realistic_Vision_V1.4-pruned-fp16.safetensors [8d21810b]
- Realistic_Vision_V2.0.safetensors [79587710]
- Realistic_Vision_V4.0.safetensors [29a7afaa]
- Realistic_Vision_V5.0.safetensors [614d1063]
- redshift_diffusion-V10.safetensors [1400e684]
- revAnimated_v122.safetensors [3f4fefd9]
- rundiffusionFX25D_v10.safetensors [cd12b0ee]
- rundiffusionFX_v10.safetensors [cd4e694d]
- sdv1_4.ckpt [7460a6fa]
- v1-5-pruned-emaonly.safetensors [d7049739]
- v1-5-inpainting.safetensors [21c7ab71]
- shoninsBeautiful_v10.safetensors [25d8c546]
- theallys-mix-ii-churned.safetensors [5d9225a4]
- timeless-1.0.ckpt [7c4971d4]
- toonyou_beta6.safetensors [980f6b15]

#### Parameters

| Parameter       | Default                          | Description                           |
|-----------------|----------------------------------|---------------------------------------|
| negative_prompt |                                  | Indicates what the AI should not do   |
| model           | absolutereality_V16.safetensors [37db0fc3] | Select from the list of models |
| cfg_scale       | 7                                | Min: 0, Max: 20                       |
| steps           | 25                               | Min: 1, Max: 30                       |
| sampler         | DPM++ 2M Karras                  | Select from these: "Euler","Euler a","Heun","DPM++ 2M Karras","DPM++ SDE Karras","DDIM" |

<a id="prodia-stablediffusion"></a>
## Usage Prodia Stable-Diffusion

```php
require "./vendor/autoload.php";

use gpti\prodia_sd;

$res = new prodia_sd(prompt:"Friends gathered around a bonfire in an ancient forest. Laughter, stories, and a starry sky paint an unforgettable moment of connection beneath the shadows of the mountains.", data:array(
    "prompt_negative" => "",
    "model" => "absolutereality_v181.safetensors [3d9d4d2b]",
    "sampling_method" => "DPM++ 2M Karras",
    "sampling_steps" => 25,
    "width" => 512,
    "height" => 512,
    "cfg_scale" => 7
));
$res->execute();

if($res->error() != null){
    print(json_encode($res->error()));
} else {
    print(json_encode($res->result()));
}
```

#### JSON

```json
{
    "code": 200,
    "status": true,
    "prompt": "Friends gathered around a bonfire in an ancient forest. Laughter, stories, and a starry sky paint an unforgettable moment of connection beneath the shadows of the mountains.",
    "model": "Prodia-StableDiffusion",
    "data": {
        "prompt_negative": "",
        "model": "absolutereality_v181.safetensors [3d9d4d2b]",
        "sampling_method": "DPM++ 2M Karras",
        "sampling_steps": 25,
        "width": 512,
        "height": 512,
        "cfg_scale": 7
    },
    "images": [
        "data:image/jpeg;base64,..."
    ]
}
```

#### Models

List of models

- absolutereality_v181.safetensors [3d9d4d2b]
- 3Guofeng3_v34.safetensors [50f420de]
- absolutereality_V16.safetensors [37db0fc3]
- amIReal_V41.safetensors [0a8a2e61]
- analog-diffusion-1.0.ckpt [9ca13f02]
- anythingv3_0-pruned.ckpt [2700c435]
- anything-v4.5-pruned.ckpt [65745d25]
- anythingV5_PrtRE.safetensors [893e49b9]
- AOM3A3_orangemixs.safetensors [9600da17]
- blazing_drive_v10g.safetensors [ca1c1eab]
- cetusMix_Version35.safetensors [de2f2560]
- childrensStories_v13D.safetensors [9dfaabcb]
- childrensStories_v1SemiReal.safetensors [a1c56dbb]
- childrensStories_v1ToonAnime.safetensors [2ec7b88b]
- Counterfeit_v30.safetensors [9e2a8f19]
- cuteyukimixAdorable_midchapter3.safetensors [04bdffe6]
- cyberrealistic_v33.safetensors [82b0d085]
- dalcefo_v4.safetensors [425952fe]
- deliberate_v2.safetensors [10ec4b29]
- deliberate_v3.safetensors [afd9d2d4]
- dreamlike-anime-1.0.safetensors [4520e090]
- dreamlike-diffusion-1.0.safetensors [5c9fd6e0]
- dreamlike-photoreal-2.0.safetensors [fdcf65e7]
- dreamshaper_6BakedVae.safetensors [114c8abb]
- dreamshaper_7.safetensors [5cf5ae06]
- dreamshaper_8.safetensors [9d40847d]
- edgeOfRealism_eorV20.safetensors [3ed5de15]
- EimisAnimeDiffusion_V1.ckpt [4f828a15]
- elldreths-vivid-mix.safetensors [342d9d26]
- epicrealism_naturalSinRC1VAE.safetensors [90a4c676]
- ICantBelieveItsNotPhotography_seco.safetensors [4e7a3dfd]
- juggernaut_aftermath.safetensors [5e20c455]
- lofi_v4.safetensors [ccc204d6]
- lyriel_v16.safetensors [68fceea2]
- majicmixRealistic_v4.safetensors [29d0de58]
- mechamix_v10.safetensors [ee685731]
- meinamix_meinaV9.safetensors [2ec66ab0]
- meinamix_meinaV11.safetensors [b56ce717]
- neverendingDream_v122.safetensors [f964ceeb]
- openjourney_V4.ckpt [ca2f377f]
- pastelMixStylizedAnime_pruned_fp16.safetensors [793a26e8]
- portraitplus_V1.0.safetensors [1400e684]
- protogenx34.safetensors [5896f8d5]
- Realistic_Vision_V1.4-pruned-fp16.safetensors [8d21810b]
- Realistic_Vision_V2.0.safetensors [79587710]
- Realistic_Vision_V4.0.safetensors [29a7afaa]
- Realistic_Vision_V5.0.safetensors [614d1063]
- redshift_diffusion-V10.safetensors [1400e684]
- revAnimated_v122.safetensors [3f4fefd9]
- rundiffusionFX25D_v10.safetensors [cd12b0ee]
- rundiffusionFX_v10.safetensors [cd4e694d]
- sdv1_4.ckpt [7460a6fa]
- v1-5-pruned-emaonly.safetensors [d7049739]
- v1-5-inpainting.safetensors [21c7ab71]
- shoninsBeautiful_v10.safetensors [25d8c546]
- theallys-mix-ii-churned.safetensors [5d9225a4]
- timeless-1.0.ckpt [7c4971d4]
- toonyou_beta6.safetensors [980f6b15]

#### Methods

List of methods:

- DPM++ 2M Karras
- Euler
- Euler a
- LMS
- Heun
- DPM2
- DPM2 a
- DPM++ 2S a
- DPM++ 2M
- DPM++ SDE
- DPM fast
- DPM adaptive
- LMS Karras
- DPM2 Karras
- DPM2 a Karras
- DPM++ 2S a Karras
- DPM++ 2M Karras
- DPM++ SDE Karras
- DDIM
- PLMS
- DPM++ 2M Karras

#### Parameters

| Parameter        | Default                               | Description                              |
|------------------|---------------------------------------|------------------------------------------|
| prompt_negative  |                                       | Indicates what the AI should not do       |
| model            | absolutereality_v181.safetensors [3d9d4d2b] | Select from the list of models     |
| sampling_method  | DPM++ 2M Karras                       | Select from the list of methods          |
| sampling_steps   | 25                                    | Min: 1, Max: 30                          |
| width            | 512                                   | Min: 50, Max: 1024                       |
| height           | 512                                   | Min: 50, Max: 1024                       |
| cfg_scale        | 7                                     | Min: 1, Max: 20                          |

<a id="prodia-stablediffusion-xl"></a>
## Usage Prodia Stable-Diffusion XL (PRO)

```php
require "./vendor/autoload.php";

use gpti\prodia_sdxl;

$res = new prodia_sdxl(prompt:"Friends gathered around a bonfire in an ancient forest. Laughter, stories, and a starry sky paint an unforgettable moment of connection beneath the shadows of the mountains.", data:array(
    "prompt_negative" => "",
    "model" => "sd_xl_base_1.0.safetensors [be9edd61]",
    "sampling_method" => "DPM++ 2M Karras",
    "sampling_steps" => 25,
    "width" => 1024,
    "height" => 1024,
    "cfg_scale" => 7
));
$res->execute();

if($res->error() != null){
    print(json_encode($res->error()));
} else {
    print(json_encode($res->result()));
}
```


#### JSON

```json
{
    "code": 200,
    "status": true,
    "prompt": "Friends gathered around a bonfire in an ancient forest. Laughter, stories, and a starry sky paint an unforgettable moment of connection beneath the shadows of the mountains.",
    "model": "Prodia-StableDiffusion-xl",
    "data": {
        "prompt_negative": "",
        "model": "sd_xl_base_1.0.safetensors [be9edd61]",
        "sampling_method": "DPM++ 2M Karras",
        "sampling_steps": 25,
        "width": 1024,
        "height": 1024,
        "cfg_scale": 7
    },
    "images": [
        "data:image/jpeg;base64,..."
    ]
}
```

#### Models

List of models:

- dreamshaperXL10_alpha2.safetensors [c8afe2ef]
- dynavisionXL_0411.safetensors [c39cc051]
- juggernautXL_v45.safetensors [e75f5471]
- realismEngineSDXL_v10.safetensors [af771c3f]
- sd_xl_base_1.0.safetensors [be9edd61]
- sd_xl_base_1.0_inpainting_0.1.safetensors [5679a81a]
- turbovisionXL_v431.safetensors [78890989]

#### Methods

List of methods:

- DPM++ 2M Karras
- Euler
- Euler a
- LMS
- Heun
- DPM2
- DPM2 a
- DPM++ 2S a
- DPM++ 2M
- DPM++ SDE
- DPM fast
- DPM adaptive
- LMS Karras
- DPM2 Karras
- DPM2 a Karras
- DPM++ 2S a Karras
- DPM++ SDE Karras

#### Parameters

| Parameter        | Default                          | Description                              |
|------------------|----------------------------------|------------------------------------------|
| prompt_negative  |                                  | Indicates what the AI should not do       |
| model            | sd_xl_base_1.0.safetensors [be9edd61] | Select from the list of models     |
| sampling_method  | DPM++ 2M Karras                  | Select from the list of methods          |
| sampling_steps   | 25                               | Min: 1, Max: 30                          |
| width            | 1024                             | Min: 512, Max: 1536                      |
| height           | 1024                             | Min: 512, Max: 1536                      |
| cfg_scale        | 7                                | Min: 1, Max: 20                          |

<a id="pixart-a"></a>
## Usage Pixart-A (PRO)

```php
require "./vendor/autoload.php";

use gpti\pixarta;

$res = new pixarta(prompt:"An urban landscape bathed in the sunset, where the warm tones of the sun reflect on modern buildings and the orange and purple sky. In the foreground, there's a group of friends gathered on a rooftop, laughing and enjoying the moment. Their expressions radiate joy and camaraderie as they embrace and point towards something on the horizon. The scene is enveloped in a nostalgic and emotional aura that conveys the beauty of friendship and the warmth of the sunset in a futuristic city with touches of anime style.", data:array(
    "prompt_negative" => "",
    "sampler" => "DPM-Solver",
    "image_style" => "Anime",
    "width" => 1024,
    "height" => 1024,
    "dpm_guidance_scale" => 4.5,
    "dpm_inference_steps" => 14,
    "sa_guidance_scale" => 3,
    "sa_inference_steps" => 25
));
$res->execute();

if($res->error() != null){
    print(json_encode($res->error()));
} else {
    print(json_encode($res->result()));
}
```


#### JSON

```json
{
    "code": 200,
    "status": true,
    "prompt": "An urban landscape bathed in the sunset, where the warm tones of the sun reflect on modern buildings and the orange and purple sky. In the foreground, there's a group of friends gathered on a rooftop, laughing and enjoying the moment. Their expressions radiate joy and camaraderie as they embrace and point towards something on the horizon. The scene is enveloped in a nostalgic and emotional aura that conveys the beauty of friendship and the warmth of the sunset in a futuristic city with touches of anime style.",
    "model": "PixArt-a",
    "data": {
        "prompt_negative": "",
        "sampler": "DPM-Solver",
        "image_style": "Anime",
        "width": 1024,
        "height": 1024,
        "dpm_guidance_scale": 4.5,
        "dpm_inference_steps": 14,
        "sa_guidance_scale": 3,
        "sa_inference_steps": 25
    },
    "images": [
        "data:image/jpeg;base64,..."
    ]
}
```

#### Parameters

| Parameter            | Default      | Description                                           |
|----------------------|--------------|-------------------------------------------------------|
| prompt_negative      |              | Indicates what the AI should not do                   |
| sampler              | DPM-Solver   | Choose among these: "DPM-Solver", "SA-Solver" |
| image_style          | (No style)   | Choose from various available image types: "(No style)", "Cinematic", "Photographic", "Anime", "Manga", "Digital Art", "Pixel art", "Fantasy art", "Neonpunk", "3D Model" |
| width                | 1024         | Min: 256, Max: 2048                                  |
| height               | 1024         | Min: 256, Max: 2048                                  |
| dpm_guidance_scale   | 4.5          | Min: 1, Max: 10                                      |
| dpm_inference_steps  | 14           | Min: 5, Max: 40                                      |
| sa_guidance_scale    | 3            | Min: 1, Max: 10                                      |
| sa_inference_steps   | 25           | Min: 10, Max: 40                                     |

<a id="pixart-lcm"></a>
## Usage Pixart-LCM (PRO)

```php
require "./vendor/autoload.php";

use gpti\pixartlcm;

$res = new pixartlcm(prompt:"An enchanted forest with twisted trees, a waterfall cascading into a pond of bright water lilies, and in the background, a magical tower surrounded by mythical creatures like unicorns, fairies, and dragons, under a starry sky and a giant moon.", data:array(
    "prompt_negative" => "",
    "image_style" => "Fantasy art",
    "width" => 1024,
    "height" => 1024,
    "lcm_inference_steps" => 9
));
$res->execute();

if($res->error() != null){
    print(json_encode($res->error()));
} else {
    print(json_encode($res->result()));
}
```

#### JSON

```json
{
    "code": 200,
    "status": true,
    "prompt": "An enchanted forest with twisted trees, a waterfall cascading into a pond of bright water lilies, and in the background, a magical tower surrounded by mythical creatures like unicorns, fairies, and dragons, under a starry sky and a giant moon.",
    "model": "PixArt-LCM",
    "data": {
        "prompt_negative": "",
        "image_style": "Fantasy art",
        "width": 1024,
        "height": 1024,
        "lcm_inference_steps": 9
    },
    "images": [
        "data:image/jpeg;base64,..."
    ]
}
```

#### Parameters

| Parameter             | Default    | Description                                                                                   |
|-----------------------|------------|-----------------------------------------------------------------------------------------------|
| prompt_negative       |            | Indicates what the AI should not do                                                           |
| image_style           | (No style) | Choose from various available image types: "(No style)", "Cinematic", "Photographic", "Anime", "Manga", "Digital Art", "Pixel art", "Fantasy art", "Neonpunk", "3D Model" |
| width                 | 1024       | Min: 256, Max: 2048                                                                          |
| height                | 1024       | Min: 256, Max: 2048                                                                          |
| lcm_inference_steps   | 9          | Min: 1, Max: 30                                                                              |

<a id="stablediffusion-1.5"></a>
## Usage Stable-Diffusion 1.5

```php
require "./vendor/autoload.php";

use gpti\sdv1;

$res = new sdv1(prompt:"An serene sunset landscape where a river winds through gentle hills covered in trees. The sky is tinged with warm and soft tones, with scattered clouds reflecting the last glimmers of the sun.");
$res->execute();

if($res->error() != null){
    print(json_encode($res->error()));
} else {
    print(json_encode($res->result()));
}
```

#### JSON

```json
{
    "code": 200,
    "status": true,
    "prompt": "An serene sunset landscape where a river winds through gentle hills covered in trees. The sky is tinged with warm and soft tones, with scattered clouds reflecting the last glimmers of the sun.",
    "model": "StableDiffusion-1.5",
    "images": [
        "data:image/jpeg;base64,...",
        "..."
    ]
}
```

<a id="stablediffusion-2.1"></a>
## Usage Stable-Diffusion 2.1

```php
require "./vendor/autoload.php";

use gpti\sdv2;

$res = new sdv2(prompt:"An serene sunset landscape where a river winds through gentle hills covered in trees. The sky is tinged with warm and soft tones, with scattered clouds reflecting the last glimmers of the sun.", data:array(
    "prompt_negative" => "",
    "guidance_scale" => 9
));
$res->execute();

if($res->error() != null){
    print(json_encode($res->error()));
} else {
    print(json_encode($res->result()));
}
```

#### JSON

```json
{
    "code": 200,
    "status": true,
    "prompt": "An serene sunset landscape where a river winds through gentle hills covered in trees. The sky is tinged with warm and soft tones, with scattered clouds reflecting the last glimmers of the sun.",
    "model": "StableDiffusion-2.1",
    "data": {
        "prompt_negative": "",
        "guidance_scale": 9
    },
    "images": [
        "data:image/jpeg;base64,...",
        "..."
    ]
}
```

#### Parameters

| Parameter         | Default | Description                           |
|-------------------|---------|---------------------------------------|
| prompt_negative   |         | Indicates what the AI should not do    |
| guidance_scale    | 9       | Min: 0 Max: 50                        |

<a id="stablediffusion-xl"></a>
## Usage Stable-Diffusion XL (PRO)

```php
require "./vendor/autoload.php";

use gpti\sdxl;

$res = new sdxl(prompt:"An serene sunset landscape where a river winds through gentle hills covered in trees. The sky is tinged with warm and soft tones, with scattered clouds reflecting the last glimmers of the sun.", data:array(
    "prompt_negative" => "",
    "image_style" => "(No style)",
    "guidance_scale" => 7.5
));
$res->execute();

if($res->error() != null){
    print(json_encode($res->error()));
} else {
    print(json_encode($res->result()));
}
```


#### JSON

```json
{
    "code": 200,
    "status": true,
    "prompt": "An serene sunset landscape where a river winds through gentle hills covered in trees. The sky is tinged with warm and soft tones, with scattered clouds reflecting the last glimmers of the sun.",
    "model": "StableDiffusion-XL",
    "data": {
        "prompt_negative": "",
        "image_style": "(No style)",
        "guidance_scale": 7.5
    },
    "images": [
        "data:image/jpeg;base64,...",
        "..."
    ]
}
```

#### Parameters

| Parameter         | Default      | Description                                                                                             |
|-------------------|--------------|---------------------------------------------------------------------------------------------------------|
| prompt_negative   |              | Indicates what the AI should not do                                                                    |
| image_style       | (No style)    | Choose from various available image types: "(No style)", "Cinematic", "Photographic", "Anime", "Manga", "Digital Art", "Pixel art", "Fantasy art", "Neonpunk", "3D Model" |
| guidance_scale    | 7.5            | Min: 0, Max: 50                                                                                        |

<a id="emi"></a>
## Usage EMI

```php
require "./vendor/autoload.php";

use gpti\emi;

$res = new emi(prompt:"A beautiful girl in a garden full of bright flowers. Her long, silky hair is adorned with flowers, and her large eyes reflect serenity. She wears a traditional kimono, smiling as she holds a delicate butterfly in her hand.");
$res->execute();

if($res->error() != null){
    print(json_encode($res->error()));
} else {
    print(json_encode($res->result()));
}
```

#### JSON

```json
{
    "code": 200,
    "status": true,
    "prompt": "A beautiful girl in a garden full of bright flowers. Her long, silky hair is adorned with flowers, and her large eyes reflect serenity. She wears a traditional kimono, smiling as she holds a delicate butterfly in her hand.",
    "model": "Emi",
    "scene": "a young woman stands in a beautiful garden, full of vibrant flowers. Her long, flowing silk kimono is adorned with the same flowers, and her large, expressive eyes seem to reflect a sense of peaceful serenity. In her hand, she clutches a delicate butterfly, which seems to be caught up in the beauty of the moment. She is surrounded",
    "images": [
        "data:image/jpeg;base64,..."
    ]
}
```

<a id="render3d"></a>
## Usage Render3D (PRO)

```php
require "./vendor/autoload.php";

use gpti\render3d;

$res = new render3d(prompt:"In a remote corner of the galaxy, a star agonizes in its final stage of life. Its brightness, once dazzling, now fades slowly into the void of space, while a bright nebula forms around it.", data:array(
    "prompt_negative" => ""
));
$res->execute();

if($res->error() != null){
    print(json_encode($res->error()));
} else {
    print(json_encode($res->result()));
}
```

#### JSON

```json
{
    "code": 200,
    "status": true,
    "prompt": "In a remote corner of the galaxy, a star agonizes in its final stage of life. Its brightness, once dazzling, now fades slowly into the void of space, while a bright nebula forms around it.",
    "model": "Render3D",
    "data": {
        "prompt_negative": ""
    },
    "images": [
        "data:image/jpeg;base64,..."
    ]
}
```

<a id="pixelart"></a>
## Usage PixelArt

```php
require "./vendor/autoload.php";

use gpti\pixelart;

$res = new pixelart(prompt:"A coastal city in the golden hour of the sunset. The sun slowly slips toward the horizon, tinting the sky with golden and pink hues. Skyscrapers stand out against this heavenly backdrop, reflecting the light in their glass windows. In the streets, lights flicker timidly, getting ready to illuminate the night.", data:array(
    "prompt_negative" => ""
));
$res->execute();

if($res->error() != null){
    print(json_encode($res->error()));
} else {
    print(json_encode($res->result()));
}
```

#### JSON

```json
{
    "code": 200,
    "status": true,
    "prompt": "A coastal city in the golden hour of the sunset. The sun slowly slips toward the horizon, tinting the sky with golden and pink hues. Skyscrapers stand out against this heavenly backdrop, reflecting the light in their glass windows. In the streets, lights flicker timidly, getting ready to illuminate the night.",
    "model": "PixelArt",
    "data": {
        "prompt_negative": ""
    },
    "images": [
        "data:image/jpeg;base64,..."
    ]
}
```

<a id="animagine-xl"></a>
## Animagine XL (PRO)

```php
require "./vendor/autoload.php";

use gpti\animaginexl;

$res = new animaginexl(prompt:"An anime girl surrounded by cherry blossoms", data:array(
    "prompt_negative" => "",
    "quality_tags" => "Standard",
    "style_present" => "(None)",
    "width" => 1024,
    "height" => 1024,
    "strength" => 0.5,
    "upscale" => 1.5,
    "sampler" => "Euler a",
    "guidance_scale" => 7,
    "inference_steps" => 28
));
$res->execute();

if($res->error() != null){
    print(json_encode($res->error()));
} else {
    print(json_encode($res->result()));
}
```


#### JSON

```json
{
    "code": 200,
    "status": true,
    "prompt": "An anime girl surrounded by cherry blossoms",
    "model": "Animagine-XL",
    "data": {
        "prompt_negative": "",
        "quality_tags": "Standard",
        "style_present": "(None)",
        "width": 1024,
        "height": 1024,
        "strength": 0.5,
        "upscale": 1.5,
        "sampler": "Euler a",
        "guidance_scale": 7,
        "inference_steps": 28
    },
    "images": [
        "data:image/jpeg;base64,..."
    ]
}
```

#### Parameters

| Parameter       | Default | Description                                                            |
|-----------------|---------|------------------------------------------------------------------------|
| prompt_negative|         | Indicates what the AI should not do                                    |
| width           | 1024    | Min: 512, Max: 2048                                                   |
| height          | 1024    | Min: 512, Max: 2048                                                   |
| guidance_scale  | 7       | Min: 1, Max: 12                                                        |
| quality_tags    | Standard| Select from these: "Standard", "Light", "Heavy", "(None)"              |
| style_present   | (None)  | Choose from various available image types: "(None)", "Cinematic", "Photographic", "Anime", "Manga", "Digital Art", "Pixel art", "Fantasy art", "Neonpunk", "3D Model" |
| strength        | 0.5     | Min: 0, Max: 1                                                         |
| upscale         | 1.5     | Min: 1, Max: 1.5                                                       |
| sampler         | Euler a | Select from these: "Euler a", "DPM++ 2M Karras", "DPM++ SDE Karras", "DPM++ 2M SDE Karras", "Euler", "DDIM" |
| inference_steps | 28      | Min: 1, Max: 50                                                        |

<a id="playground"></a>
## Playground (PRO)

```php
require "./vendor/autoload.php";

use gpti\playground;

$res = new playground(prompt:"An illustration of a red owl with bright blue eye", data:array(
    "prompt_negative" => "",
    "width" => 1024,
    "height" => 1024,
    "guidance_scale" => 3
));
$res->execute();

if($res->error() != null){
    print(json_encode($res->error()));
} else {
    print(json_encode($res->result()));
}
```

#### JSON

```json
{
    "code": 200,
    "status": true,
    "prompt": "An illustration of a red owl with bright blue eyes.",
    "model": "Playground",
    "data": {
        "prompt_negative": "",
        "width": 1024,
        "height": 1024,
        "guidance_scale": 3
    },
    "images": [
        "data:image/jpeg;base64,..."
    ]
}
```

#### Parameters

| Parameter       | Default | Description                                                            |
|-----------------|---------|------------------------------------------------------------------------|
| prompt_negative|         | Indicates what the AI should not do                                    |
| width           | 1024    | Min: 256, Max: 1536                                                   |
| height          | 1024    | Min: 256, Max: 1536                                                   |
| guidance_scale  | 3       | Min: 0.1, Max: 20                                                      |

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

## ☕ Do you want to support this project?

If this package has helped you save time or solve a problem, consider inviting me for a coffee through Ko-fi. Your support helps me maintain and improve this project for you and other users like you. Furthermore, each donation contributes to the creation and free availability of more AI models in the future. Every small donation counts and is greatly appreciated!

[![Support on Ko-fi](https://www.ko-fi.com/img/githubbutton_sm.svg)](https://ko-fi.com/yandricr)