// netlify/functions/memeQuote.js

// If you're using Node 18+, global.fetch is available.
// Otherwise, you might need to install node-fetch: npm install node-fetch
// and then: const fetch = require('node-fetch');

exports.handler = async (event, context) => {
  try {
    // Fetch a random meme from Meme API
    const memeResponse = await fetch('https://meme-api.herokuapp.com/gimme');
    if (!memeResponse.ok) {
      throw new Error(`Meme API error: ${memeResponse.status}`);
    }
    const memeData = await memeResponse.json();

    // Fetch a random quote from Quotable API
    const quoteResponse = await fetch('https://api.quotable.io/random');
    if (!quoteResponse.ok) {
      throw new Error(`Quote API error: ${quoteResponse.status}`);
    }
    const quoteData = await quoteResponse.json();

    return {
      statusCode: 200,
      headers: {
        "Access-Control-Allow-Origin": "*", // allow requests from any origin
        "Content-Type": "application/json"
      },
      body: JSON.stringify({
        meme: memeData,
        quote: quoteData
      })
    };
  } catch (error) {
    return {
      statusCode: 500,
      headers: { "Access-Control-Allow-Origin": "*" },
      body: JSON.stringify({ error: error.message })
    };
  }
};
