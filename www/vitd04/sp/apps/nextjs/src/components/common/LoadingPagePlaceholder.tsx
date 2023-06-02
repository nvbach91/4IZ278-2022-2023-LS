import React from "react";
import { Spinner } from "./Spinner";

type Props = {};

function LoadingPagePlaceholder({}: Props) {
  return (
    <div className="w-full h-full">
      <Spinner />
    </div>
  );
}

export default LoadingPagePlaceholder;
