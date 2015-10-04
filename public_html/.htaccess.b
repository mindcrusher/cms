DirectoryIndex index.php?type=page&id=1&pid=0
RewriteEngine on

RewriteRule ^global/scms/view/93/?		/page/5/13/		[R]
RewriteRule ^global/scms/view/89/?		/page/0/3/		[R]
RewriteRule ^global/scms/view/95/?		/page/0/9/		[R]
RewriteRule ^global/scms/view/93/?		/page/5/13/		[R]
RewriteRule ^global/scms/view/92/?		/page/5/12/		[R]


RewriteRule ^(page|item|news)/([0-9]+)/([0-9]+)/?((ru|en)/?)?$	index.php?type=$1&id=$3&pid=$2&lang=$5
RewriteRule ^(page|item|news)/([0-9]+)/([0-9]+)/-([0-9]+)$	index.php?type=$1&id=$3&pid=$2&p=$4
RewriteRule ^(page|item|news)/([0-9]+)/([0-9]+)/:([0-9]+)$	index.php?type=$1&id=$3&pid=$2&filter=$4
RewriteRule ^(page|item|news)-([0-9]+)-([0-9]+)/?$				index.php?type=$1&id=$3&pid=$2&lang=$5
RewriteRule ^feedback/?$	index.php?type=feedback&id=0&pid=0
RewriteRule ^feedback/([a-z]+)/?$	feedback.php?type=$1
RewriteRule ^sitemap/?$		index.php?type=sitemap&id=$3&pid=$2
RewriteRule ^sitemap.xml$	commons/sitemap.php
RewriteRule ^rss			commons/rss.php
RewriteRule ^backup$		commons/backup.php?return=1

<FilesMatch "\.(ini|sql)$">
deny from all
</FilesMatch>