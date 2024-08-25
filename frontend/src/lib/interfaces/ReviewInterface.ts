interface ReviewInterface {
  review_id: string;
  review_type: string;
  rating: string;
  author_id: string;
  content: string;
  approved: boolean;
  created_at: string;
  updated_at: string;
}

export default ReviewInterface;
