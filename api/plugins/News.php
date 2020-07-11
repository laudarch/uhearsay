<?php
class News {    
	public static function latest($page, $country)
	{
		$ts = time() - 3600;
		$response = get_news("https://webhose.io/search?token=xxxYOUR_TOKEN_HERExxx&format=json&q=language%3A(english)%20thread.country%3AGH%20(site_type%3Anews)&ts=$ts");

        $news_articles = "";

        // Generate news
        if ($response->code == 200):
				foreach($response->body->posts as $item): 
                    $url           = getUrl($item->url);
                    $image         = (strlen($item->thread->main_image) > 0) ? $item->thread->main_image : "assets/images/noimage";
                    $title         = $item->title;
                    $content       = (strlen($item->text) > 50) ? substr($item->text, 0, 50)."... <a href='$url'>Read More</a>" : $item->text;
                    $published     = date_to_words($item->published);
                    $author        = (strlen($item->author) > 0) ? $item->author : "N/A";
                    $news_articles .= <<<NEWS
                        <div class="image fit">
								<a href="$url" target="_blank">
									<img src="$image" alt="$title" />
									<p>$title</p>
								</a>
								<p>
                                    $content
                                    <span class="footnote">Published $published By: $author</span>    
                                </p>
                                
				        </div>
NEWS;
				endforeach;
        endif;

        print $news_articles;
	}
}
?>
