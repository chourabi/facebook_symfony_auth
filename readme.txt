composer require facebook/graph-sdk


create facebbook app as a "Entreprise" role

copie redirect url to facebook app

request authorizations pages_manage_posts pages_read_engagement in the facebook developers platform

/*************************************************/

DB

User
    + facebookAccessToken

LinkedFacebookPage

    + id
    + pageID
    + pageAccessToken
    + pageName
    + user