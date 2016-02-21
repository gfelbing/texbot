# texbot

A leightweight telegram latex bot using the Google Chart API

## Intro

This bot takes a received message, puts it into a latex \text{.} block, except for $-fenced expressions.
It replies with the according link for the Google-Chart API using the Tex-Interface.

See [Google Chart API - Documentation](https://developers.google.com/chart/infographics/docs/formulas).

For example, if it receives:

```
This will be math: $m=a^t_h$.
Expressions like $20,000 and $30,000 won’t parse as math.
If for some reason you need to enclose text in literal $ characters.
As you will see, the @BOT_NAME will be removed.
```

The text will be translated into:

```
\text{This will be math: }m=a^t_h\text{.
Expressions like $20,000 and $30,000 won’t parse as math.
If for some reason you need to enclose text in literal $ characters.
As you will see, the  will be removed.}
```

This will be urlencoded and apended to the following API-Call:

`https://chart.googleapis.com/chart?cht=tx&chs=75&chl=`

And finally, this link will be replied to the chat.
Since it has an image MIME, telegram will view the result directly in the chat.

*NOTE*: In group-chats, the bot receives only messages in which he is mentioned per default.
I think thats good behaviour, since you have full control when it replies or not.
Just add him to a group chat and @mention him.

## How to use

1. Put it into your Webspace.
2. Create a `secret.php` defining the PHP-Constants `BOT_TOKEN`, `API_URL` and `BOT_NAME`.
3. Register your Webhook-Bot (See [Telegram Bot Docu](https://core.telegram.org/bots/api) for more information)
4. Have fun!
