<?php

use Illuminate\Database\Seeder;
use PRAXXYS\Admin\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	// Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        $default = [
                [
                    'name' =>'index',
                    'description' => 'Index '
                ],
                [
                    'name' =>'create',
                    'description' => 'Create '
                ],
                [
                    'name' =>'store',
                    'description' => 'Store '
                ],
                [
                    'name' =>'edit',
                    'description' => 'Edit '
                ],
                [
                    'name' =>'show',
                    'description' => 'Show '
                ],
                [
                    'name' =>'destroy',
                    'description' => 'Destroy '
                ],
        ];

        $permissions = [
                'articles' => [
                    [
                        'name' => 'featured',
                        'description' => 'Featured Article'
                    ],
                    [
                        'name' => 'unfeatured',
                        'description' => 'Unfeatured Article'
                    ],
                    [
                        'name' => 'publish',
                        'description' => 'Publish Article'
                    ],
                    [
                        'name' => 'unpublish',
                        'description' => 'Unpublish Article'
                    ],
                ],
                'invoices' => [
                    [
                        'name' => 'setAsProcessed',
                        'description' => 'Set Invoice as Processed'
                    ],
                    [
                        'name' => 'setAsCancelled',
                        'description' => 'Set Invoice as Cancelled'
                    ],
                    [
                        'name' => 'transit',
                        'description' => 'Set Invoice as In Transit'
                    ],
                    [
                        'name' => 'setAsDelivered',
                        'description' => 'Set Invoice as Delivered'
                    ],
                    [
                        'name' => 'setAsPaid',
                        'description' => 'Set Invoice as Paid'
                    ],
                    [
                        'name' => 'setTrackingNumber',
                        'description' => 'Set Invoice Tracking Number'
                    ],
                    [
                        'name' => 'printInvoice',
                        'description' => 'Print Invoice'
                    ],
                    [
                        'name' => 'generateSalesReport',
                        'description' => 'Automatically Generate Excel Report'
                    ],
                    [
                        'name' => 'generate',
                        'description' => 'Generate Report'
                    ],
                ],
                'products' => [
                    [
                        'name' => 'featured',
                        'description' => 'Featured Product'
                    ],
                    [
                        'name' => 'delete',
                        'description' => 'Delete Products'
                    ],
                    [
                        'name' => 'batchUploadProduct',
                        'description' => 'Batch Upload of Products'
                    ],
                    [
                        'name' => 'batchUpdateProductPrice',
                        'description' => 'Batch Update of Products Price'
                    ],
                    [
                        'name' => 'handleBatchUploadProduct',
                        'description' => 'Handle Batch Upload of Products'
                    ],
                    [
                        'name' => 'handleBatchUpdateProductPrice',
                        'description' => 'HandleBatch Update of Products Price'
                    ],
                ],

			'product_sales' => [
                [
                    'name' => 'unsaleIndex',
                    'description' => 'Product Sale Management Index'
                ],
                [
                    'name' => 'unsaleCreate',
                    'description' => 'Product Sale Management Create'
                ],
                [
                    'name' => 'unsaleStore',
                    'description' => 'Product Sale Management Store'
                ],
                [
                    'name' => 'unsaleEdit',
                    'description' => 'Product Sale Management Edit'
                ],
                [
                    'name' => 'unsaleUpdate',
                    'description' => 'Product Sale Management Update'
                ],
                [
                    'name' => 'unsaleDestroy',
                    'description' => 'Product Sale Management Destroy'
                ],
            ],
            
            'admin_featured_products' => [
                [
                    'name' => 'sort',
                    'description' => 'Sort Featured on Sale Products',
                ],
            ],

            'admin_carousel_images' => [
                [
                    'name' => 'sort',
                    'description' => 'Sorting of Carousel Images',
                ],
            ],

            'admin_product_inventories' => [
                [
                    'name' => 'import',
                    'description' => 'Batch Import Product Inventory',
                ],
            ],

            'dashboard' => [
                [
                    'name' => 'myDashboard',
                    'description' => 'Can View Dashboard'
                ],
            ],

            'product_featured' => [
                [
                    'name' => 'unFeatured',
                    'description' => 'Unfeatured Product'
                ],
            ],

            'product_deleted' => [
                [
                    'name' => 'restore',
                    'description' => 'Restore Deleted Product'
                ],
            ],

            'sub_categories' => [
                [
                    'name' => 'restore',
                    'description' => 'Restore Deleted Sub Category'
                ],
                [
                    'name' => 'deletedProduct',
                    'description' => 'Sub Category Deleted Index'
                ],
            ],

            'admin_featured_products' => [
                [
                    'name' => 'sort',
                    'description' => 'Sort Featured Product'
                ],
            ],

            'careers' => [],
            'career_perks' => [],
            'carousels' => [],
            'pages' => [],
            'general_banners' => [],
            'header_footers' => [],
            'interactive_abouts' => [],
            'interactive_pages' => [],
            'interactive_page_items' => [],
            'brands' => [],
            'product_categories' => [],
            'product_sale_durations' => [],
            'shipping-rates' => [],
            'stores' => [],
            'subscribers' => [],
            'system-settings' => [],
        ];


    	foreach ($permissions as $name => $permissionArray) {
    		foreach($permissionArray as $item) {
    			$item['name'] = $name . '.' . $item['name'] ;
    			Permission::create($item + ['system' => true]);
    		}
    		foreach($default as $item) {

    			$expandName = title_case(str_replace('_', ' ', $name));

    			$item['name'] = $name . '.' . $item['name'];
    			$item['description'] .= $expandName; 
    			Permission::create($item + ['system' => true]);
    		}

    	}
    }
}
