import ReviewInterface from './ReviewInterface';

interface ProductInterface {
  created_at: string;
  deleted_at: string;
  description: string;
  id: string;
  name: string;
  producer_id: string;
  updated_at: string;
  product_meta: {
    meta_id: string;
    meta_key: string;
    meta_value: string;
  }[];
}

export default ProductInterface;
