import CompanyInterface from "./CompanyInterface";
import ProductInterface from "./ProductInterface";

interface SearchResultsInterface {
  companies: CompanyInterface[];
  products: ProductInterface[];
  search_key: string;
}

export default SearchResultsInterface;
