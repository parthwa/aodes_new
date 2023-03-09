<?php
/**
 * comment for template*
 * Template Name: Product list with add to cart page

 */

get_header(); ?>
<section class="product_list_section product_list_add_to_Cart">
    <div class="container-xxxl container-xxl container">
        <div class="product_detail_wrap">
            <div class="row">
                <div class="col-md-3">
                    <div class="side_filter">
                        <div class="vehicle_part_filter">
                            <h2 class="f_title"> VEHICLE PARTS FILTER</h2>
                            <div class="selection year_wrap">
                                <select name="year" class="select2 form-control">
                                    <option value="">Select Year</option>
                                    <option value="2018">2018</option>
                                    <option value="2019">2019</option>
                                    <option value="2020">2020</option>
                                    <option value="2021">2021</option>
                                    <option value="2022">2022</option>
                                </select>
                            </div>
                            <div class="selection make_wrap">
                                <select name="make" class="select2 form-control">
                                    <option value="">Select Make</option>
                                    <option value="2018">2018</option>
                                    <option value="2019">2019</option>
                                    <option value="2020">2020</option>
                                    <option value="2021">2021</option>
                                    <option value="2022">2022</option>
                                </select>
                            </div>
                            <div class="selection model_wrap">
                                <select name="model" class="select2 form-control">
                                    <option value="">Select Model</option>
                                    <option value="2018">2018</option>
                                    <option value="2019">2019</option>
                                    <option value="2020">2020</option>
                                    <option value="2021">2021</option>
                                    <option value="2022">2022</option>
                                </select>
                            </div>
                            <div class="selection category_wrap">
                                <select name="category" class="select2 form-control">
                                    <option value="">Select Category</option>
                                    <option value="2018">2018</option>
                                    <option value="2019">2019</option>
                                    <option value="2020">2020</option>
                                    <option value="2021">2021</option>
                                    <option value="2022">2022</option>
                                </select>
                            </div>
                            <div class="product_name">
                                <input type="text" name="product_name" class="form-control product_name" placeholder="Product name">
                            </div>
                            <div class="submit_wrap text-center">
                                <input type="submit" name="submit" value="Search" class="submit w-100">
</div>
                        </div>
                        <div class="product_categories_filter">
                            <h2 class="f_title"> PRODUCT CATEGORIES</h2>
                            <ul class="parent_ul">
                                <li class="parents_categories"><i class="fa fa-folder"></i> GENERATORS PARTS <span class="count_categories">(53)</span></li>
                                <li class="parents_categories"><i class="fa fa-folder"></i> DIAGRAMS <span class="count_categories">(9615)</span></li>
                                <li class="parents_categories">
                                    <i class="fa fa-folder"></i> GEAR <span class="count_categories">(10)</span>
                                    <div class="sub_categories">
                                        <ul>
                                            <li class="s_category"><i class="fa fa-folder"></i> GOOGLES & EYE PROTECTION <span class="count_categories">(1)</span></li>
                                            <li class="s_category"><i class="fa fa-folder"></i> HELMETS <span class="count_categories">(39)</span></li>  
                                            <li class="s_category">
                                                <i class="fa fa-folder-open"></i> CLOTHING <span class="count_categories">(51)</span>
                                                <div class="sub_categories">
                                                    <ul>
                                                        <li class="s_category active"><i class="fa fa-folder"></i> HATS <span class="count_categories">(18)</span></li>
                                                        <li class="s_category"><i class="fa fa-folder"></i> SHIRTS <span class="count_categories">(26)</span></li> 
                                                    </ul>
                                                </div> 
                                            </li>   
                                            <li class="s_category"><i class="fa fa-folder"></i> DRINWARE <span class="count_categories">(2)</span></li>  
                                            <li class="s_category"><i class="fa fa-folder"></i> SIGNS, DECALS, MISC<span class="count_categories">(5)</span></li>  
                                        </ul> 
                                    </div>
                                </li>
                                <li class="parents_categories"><i class="fa fa-folder"></i> ACCESSORIES <span class="count_categories">(408)</span></li>
                                <li class="parents_categories"><i class="fa fa-folder"></i> ENGINE <span class="count_categories">(2651)</span></li>
                                <li class="parents_categories"><i class="fa fa-folder"></i> BODY <span class="count_categories">(1121)</span></li>
                                <li class="parents_categories"><i class="fa fa-folder"></i> MAINTENANCE <span class="count_categories">(856)</span></li>
                                
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                <section class="brator-breadcrumb-area">
					
						<div class="row">
							<div class="col-lg-12">
                            <ul class="breadcrumb">
                                <li><a href="#">Home</a></li>
                                <li><a href="#">Parts</a></li>
                                <li><a href="#">Diagrams</a></li>
 
                            </ul>
							</div>
						</div>
					
				</section>
                
                <div class="filter_pagination">
                    <div class="row">
                        <div class="col-md-6 sortby_wrap">
                            <div class="row">
                                <div class="col-md-6">
                                    <select name="sortby" class="select2 form-control">
                                        <option value="1">Relevance</option>
                                        <option value="2">Sort by latest</option>
                                        <option value="3">Sort by price: low to high</option>
                                        <option value="4">Sort by price: high to low</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <p class="result_count">Showing 1-12 of 9615 results</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            
                                <div class="brator-pagination-box brator-product-pagination">
                
                                    <nav class="navigation pagination" aria-label="Posts">
                                        <h2 class="screen-reader-text">Posts navigation</h2>
                                        <div class="nav-links">
                                            <a class="prev page-numbers" href="https://aodes.solutiontrackers.com/shop/"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"></path>
                                                    </svg></a>
                                            <a class="page-numbers" href="https://aodes.solutiontrackers.com/shop/">1</a>
                                            <a class="page-numbers current" href="https://aodes.solutiontrackers.com/shop/">2</a>
                                            <a class="page-numbers" href="https://aodes.solutiontrackers.com/shop/page/3/">3</a>
                                            <a class="page-numbers" href="https://aodes.solutiontrackers.com/shop/page/4/">4</a>
                                            <a class="page-numbers" href="https://aodes.solutiontrackers.com/shop/page/5/">5</a>
                                            
                                            <span class="page-numbers" >...</span>
                                            <a class="page-numbers" href="https://aodes.solutiontrackers.com/shop/page/999/">999</a>
                                            <a class="next page-numbers" href="https://aodes.solutiontrackers.com/shop/page/2/"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"  style="    transform: rotate(180deg);" class="bi bi-chevron-right" viewBox="0 0 16 16">
                                                        <path  fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"></path></svg></a>
                                        </div>
                                    </nav>				
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row products_list" >
                        <div class="col-md-3 product_item">
                            <div class="product_item_wrap">
                            
                                <img src="https://aodes.solutiontrackers.com/wp-content/uploads/2022/09/vehicle-4-1.png" class="img product-image">
                                <h3 class="product_title">Product name</h3>
                                <h2 class="price">$24.99</h2>
                                    <a href="#" class="produc_item_a">
                                    Add to cart
                                </a>
                            </div>
                        </div>
                        <div class="col-md-3 product_item">
                            <div class="product_item_wrap">
                            
                                <img src="https://aodes.solutiontrackers.com/wp-content/uploads/2022/09/vehicle-3.png" class="img product-image">
                                <h3 class="product_title">Product name</h3>
                                <h2 class="price">$24.99</h2>
                                <a href="#" class="produc_item_a">
                                    Add to cart
                                </a>
                            </div>
                            
                        </div>
                        <div class="col-md-3 product_item">
                            <div class="product_item_wrap">
                            
                                <img src="https://aodes.solutiontrackers.com/wp-content/uploads/2022/09/vehicle-1.png" class="img product-image">
                                <h3 class="product_title">Product name</h3>
                                <h2 class="price">$24.99</h2>
                                <a href="#" class="produc_item_a">
                                    Add to cart
                                </a>
                            </div>
                            
                        </div>
                        <div class="col-md-3 product_item">
                            <div class="product_item_wrap">
                            
                                <img src="https://aodes.solutiontrackers.com/wp-content/uploads/2022/09/vehicle-2.png" class="img product-image">
                                <h3 class="product_title">Product name</h3>
                                <h2 class="price">$24.99</h2>
                                <a href="#" class="produc_item_a">
                                    Add to cart
                                </a>
                            </div>
                            
                        </div>
                        <div class="col-md-3 product_item">
                            <div class="product_item_wrap">
                            
                                <img src="https://aodes.solutiontrackers.com/wp-content/uploads/2022/09/vehicle-4-1.png" class="img product-image">
                                <h3 class="product_title">Product name</h3>
                                <h2 class="price">$24.99</h2>
                                <a href="#" class="produc_item_a">
                                    Add to cart
                                </a>
                            </div>
                            
                        </div>
                        <div class="col-md-3 product_item">
                            <div class="product_item_wrap">
                            
                                <img src="https://aodes.solutiontrackers.com/wp-content/uploads/2022/09/vehicle-3.png" class="img product-image">
                                <h3 class="product_title">Product name</h3>
                                <h2 class="price">$24.99</h2>
                                <a href="#" class="produc_item_a">
                                    Add to cart
                                </a>
                            </div>
                            
                        </div>
                        <div class="col-md-3 product_item">
                            <div class="product_item_wrap">
                            
                                <img src="https://aodes.solutiontrackers.com/wp-content/uploads/2022/09/vehicle-1.png" class="img product-image">
                                <h3 class="product_title">Product name</h3>
                                <h2 class="price">$24.99</h2>
                                <a href="#" class="produc_item_a">
                                    Add to cart
                                </a>
                            </div>
                            
                        </div>
                        <div class="col-md-3 product_item">
                            <div class="product_item_wrap">
                            
                                <img src="https://aodes.solutiontrackers.com/wp-content/uploads/2022/09/vehicle-2.png" class="img product-image">
                                <h3 class="product_title">Product name</h3>
                                <h2 class="price">$24.99</h2>
                                <a href="#" class="produc_item_a">
                                    Add to cart
                                </a>
                            </div>
                            
                        </div>
                        <div class="col-md-3 product_item">
                            <div class="product_item_wrap">
                            
                                <img src="https://aodes.solutiontrackers.com/wp-content/uploads/2022/09/vehicle-4-1.png" class="img product-image">
                                <h3 class="product_title">Product name</h3>
                                <h2 class="price">$24.99</h2>
                                <a href="#" class="produc_item_a">
                                    Add to cart
                                </a>
                            </div>
                            
                        </div>
                        <div class="col-md-3 product_item">
                            <div class="product_item_wrap">
                            
                                <img src="https://aodes.solutiontrackers.com/wp-content/uploads/2022/09/vehicle-3.png" class="img product-image">
                                <h3 class="product_title">Product name</h3>
                                <h2 class="price">$24.99</h2>
                                <a href="#" class="produc_item_a">
                                    Add to cart
                                </a>
                            </div>
                            
                        </div>
                        <div class="col-md-3 product_item">
                            <div class="product_item_wrap">
                            
                                <img src="https://aodes.solutiontrackers.com/wp-content/uploads/2022/09/vehicle-1.png" class="img product-image">
                                <h3 class="product_title">Product name</h3>
                                <h2 class="price">$24.99</h2>
                                <a href="#" class="produc_item_a">
                                    Add to cart
                                </a>
                            </div>
                            
                        </div>
                        <div class="col-md-3 product_item">
                            <div class="product_item_wrap">
                            
                                <img src="https://aodes.solutiontrackers.com/wp-content/uploads/2022/09/vehicle-2.png" class="img product-image">
                                <h3 class="product_title">Product name</h3>
                                <h2 class="price">$24.99</h2>
                                <a href="#" class="produc_item_a">
                                    Add to cart
                                </a>
                            </div>
                            
                        </div>
                        <div class="col-md-3 product_item">
                            <div class="product_item_wrap">
                            
                                <img src="https://aodes.solutiontrackers.com/wp-content/uploads/2022/09/vehicle-4-1.png" class="img product-image">
                                <h3 class="product_title">Product name</h3>
                                <h2 class="price">$24.99</h2>
                                <a href="#" class="produc_item_a">
                                    Add to cart
                                </a>
                            </div>
                            
                        </div>
                        <div class="col-md-3 product_item">
                            <div class="product_item_wrap">
                            
                                <img src="https://aodes.solutiontrackers.com/wp-content/uploads/2022/09/vehicle-3.png" class="img product-image">
                                <h3 class="product_title">Product name</h3>
                                <h2 class="price">$24.99</h2>
                                <a href="#" class="produc_item_a">
                                    Add to cart
                                </a>
                            </div>
                            
                        </div>
                        <div class="col-md-3 product_item">
                            <div class="product_item_wrap">
                            
                                <img src="https://aodes.solutiontrackers.com/wp-content/uploads/2022/09/vehicle-1.png" class="img product-image">
                                <h3 class="product_title">Product name</h3>
                                <h2 class="price">$24.99</h2>
                                <a href="#" class="produc_item_a">
                                    Add to cart
                                </a>
                            </div>
                            
                        </div>
                        <div class="col-md-3 product_item">
                            <div class="product_item_wrap">
                            
                                <img src="https://aodes.solutiontrackers.com/wp-content/uploads/2022/09/vehicle-2.png" class="img product-image">
                                <h3 class="product_title">Product name</h3>
                                <h2 class="price">$24.99</h2>
                                <a href="#" class="produc_item_a">
                                    Add to cart
                                </a>
                            </div>
                            
                        </div>
                    </div>
                    <div class="filter_pagination">
                    <div class="row">
                        <div class="col-md-6 sortby_wrap">
                            <div class="row">
                                <div class="col-md-6">
                                    <select name="sortby" class="select2 form-control">
                                        <option value="1">Relevance</option>
                                        <option value="2">Sort by latest</option>
                                        <option value="3">Sort by price: low to high</option>
                                        <option value="4">Sort by price: high to low</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <p class="result_count">Showing 1-12 of 9615 results</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            
                                <div class="brator-pagination-box brator-product-pagination">
                
                                    <nav class="navigation pagination" aria-label="Posts">
                                        <h2 class="screen-reader-text">Posts navigation</h2>
                                        <div class="nav-links">
                                            <a class="prev page-numbers" href="https://aodes.solutiontrackers.com/shop/"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"></path>
                                                    </svg></a>
                                            <a class="page-numbers" href="https://aodes.solutiontrackers.com/shop/">1</a>
                                            <a class="page-numbers current" href="https://aodes.solutiontrackers.com/shop/">2</a>
                                            <a class="page-numbers" href="https://aodes.solutiontrackers.com/shop/page/3/">3</a>
                                            <a class="page-numbers" href="https://aodes.solutiontrackers.com/shop/page/4/">4</a>
                                            <a class="page-numbers" href="https://aodes.solutiontrackers.com/shop/page/5/">5</a>
                                            
                                            <span class="page-numbers" >...</span>
                                            <a class="page-numbers" href="https://aodes.solutiontrackers.com/shop/page/999/">999</a>
                                            <a class="next page-numbers" href="https://aodes.solutiontrackers.com/shop/page/2/"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"  style="    transform: rotate(180deg);" class="bi bi-chevron-right" viewBox="0 0 16 16">
                                                        <path  fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"></path></svg></a>
                                        </div>
                                    </nav>				
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer();?>