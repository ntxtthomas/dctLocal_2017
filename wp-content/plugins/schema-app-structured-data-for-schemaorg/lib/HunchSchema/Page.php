<?php

defined('ABSPATH') OR die('This script cannot be accessed directly.');

/**
 * Description of Article
 *
 * @author mark
 */
class HunchSchema_Page extends HunchSchema_Thing
{
    public $schemaType = "Article";

    /**
     * Get Default Schema.org for Resource
     * 
     * @param type boolean
     * @return type string
     */
    public function getResource($pretty = false)
    {
        global $post;

        $Permalink = get_permalink();

        if ( is_front_page() )
        {
			$Permalink = get_site_url();
        }

        $MarkupType = get_post_meta( $post->ID, '_HunchSchemaType', true );
		$this->schemaType = $MarkupType ? $MarkupType : $this->schemaType;


        if (is_admin()) {
            $description = "DESCRIPTION IS EMPTY WHILE EDITING";
        } else {
            $description = wp_trim_excerpt();
        }

        $this->schema = array(
            '@context' => 'http://schema.org/',
            '@type' => $this->schemaType,
            'mainEntityOfPage' => array
            (
				"@type" => "WebPage",
				"@id" => $Permalink,
			),
            'headline' => get_the_title(),
            'description' => $description,
            'datePublished' => get_the_date('Y-m-d'),
            'dateModified' => get_the_modified_date('Y-m-d'),
            'author' => $this->getAuthor(),
            'publisher' => $this->getPublisher(),
            'image' => $this->getImage(),
        );


        return $this->toJson( $this->schema, $pretty );
    }


    public function getBreadcrumb( $Pretty = false )
    {
		global $post;

		$BreadcrumbPosition = 1;
		$this->SchemaBreadcrumb['@context'] = 'http://schema.org';
		$this->SchemaBreadcrumb['@type'] = 'BreadcrumbList';

		$this->SchemaBreadcrumb['itemListElement'][] = array
		(
			'@type' => 'ListItem',
			'position' => $BreadcrumbPosition++,
			'item' => array
			(
				'@id' => get_site_url() . "#breadcrumbitem",
				'name' => get_bloginfo( 'name' ),
			),
		);

		if ( $post->post_parent )
		{
			$Ancestors = array_reverse( get_post_ancestors( $post->ID ) );

			foreach( $Ancestors as $PostId )
			{
				$this->SchemaBreadcrumb['itemListElement'][] = array
				(
					'@type' => 'ListItem',
					'position' => $BreadcrumbPosition++,
					'item' => array
					(
						'@id' => get_permalink( $PostId ),
						'name' => get_the_title( $PostId ),
					),
				);
			}
		}

                if ( ! is_front_page() ) {
                    $this->SchemaBreadcrumb['itemListElement'][] = array
                    (
                            '@type' => 'ListItem',
                            'position' => $BreadcrumbPosition++,
                            'item' => array
                            (
                                    '@id' => get_permalink() . "#breadcrumbitem",
                                    'name' => get_the_title(),
                            ),
                    );
                }

        return $this->toJson( $this->SchemaBreadcrumb, $Pretty );
    }
}